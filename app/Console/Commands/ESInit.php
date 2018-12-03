<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ESInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'init laravel es for post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //テンプレートを作る
        $client = new Client();

        $url=config('scout.elasticsearch.hosts')[0] . '/_template/tmp';

        //$client->delete($url);

        $param=[
          'json'=>[
            'template'=>config('scout.elasticsearch.index'),
            'mappings'=>[
              '_default_'=>[
                  'dynamic_templates'=>[
                      [
                          'strings'=>[
                              'match_mapping_type'=>'string',
                              'mapping'=>[
                                  'type'=>'text',
                                  'analyzer'=>'ik_smart',
                                  'fields'=>[
                                      'keyword'=>[
                                          'type'=>'keyword'
                                      ]
                                  ]
                              ]

                          ]
                      ]
                  ]
              ]
            ],
          ],
        ];
        $client->put($url,$param);

        $this->info("========テンプレート完成======");
        //indexを作る

        $url=config('scout.elasticsearch.hosts')[0] . '/' . config('scout.elasticsearch.index');
        //$client->delete($url);
        $param=[

            'json'=>[
                'settings'=>[
                  'refresh_interval'=>'5s',
                  'number_of_shards'=>1,
                  'number_of_replicas'=>0,
                ],
                'mappings'=>[
                    '_default_'=>[
                        '_all'=>[
                            'enabled'=>false
                        ]
                    ]
                ]
            ]
        ];

        try{
            $client->put($url,$param);
        }catch (\Exception $e){
            $this->info("====セッティング失敗しました" . $e->getMessage());
        }

        $this->info("========セッティング完成======");

    }
}
