<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\AgentModel;
use App\Models\AgentType;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        if (is_null(AgentType::first())) {
            $types = [
                [
                    'name'        => '內部流程 AI 助理',
                    'description' => '內部流程 AI 助理主要會根據您上傳的知識庫內容，回覆組織內部流程相關問題。',
                ],
                [
                    'name'        => '客服 AI 助理',
                    'description' => '客服 AI 助理主要會根據您上傳的知識庫內容，提供回覆客服問題的指引。',
                ],
            ];

            $models = [
                [
                    'name' => 'gemini-2.0-flash-exp',
                ],
                [
                    'name' => 'LLaMA',
                ],
                [
                    'name' => 'openai',
                ],
            ];


            foreach ($types as $type) {
                AgentType::create($type);
            }//end foreach

            foreach ($models as $model) {
                AgentModel::create($model);
            }//end foreach
        }//end if
    }
}
