<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
          ->insert(
              [
                  'name' => 'TestUser',
                  'email' => 'machidada@gmail.com',
                  'password' => \Illuminate\Support\Facades\Hash::make('password')
              ]
          );

        DB::table('projects')
          ->insert(
              [
                  'name' => 'Sample Project',
                  'created_user_id' => 1
              ]
          );

        DB::table('statuses')
          ->insert(
              [
                  [
                      'project_id' => 1,
                      'subject' => 'Inbox',
                      'order_num' => 1
                  ],
                  [
                      'project_id' => 1,
                      'subject' => 'Todo',
                      'order_num' => 2
                  ],
                  [
                      'project_id' => 1,
                      'subject' => 'Complete',
                      'order_num' => 3
                  ]
              ]
          );

        DB::table('tasks')
          ->insert([
              [
                  'subject' => 'ほげほげほげ',
                  'created_user_id' => 1,
                  'assignee_user_id' => 1,
                  'status_id' => 1,
                  'order_num' => 1
              ],
              [
                  'subject' => 'フガフガ',
                  'created_user_id' => 1,
                  'assignee_user_id' => 1,
                  'status_id' => 1,
                  'order_num' => 2
              ],
              [
                  'subject' => 'ぼへぼへ',
                  'created_user_id' => 1,
                  'assignee_user_id' => 1,
                  'status_id' => 2,
                  'order_num' => 1
              ],
              [
                  'subject' => 'へけけ',
                  'created_user_id' => 1,
                  'assignee_user_id' => 1,
                  'status_id' => 2,
                  'order_num' => 2
              ],
              [
                  'subject' => 'ふごふご',
                  'created_user_id' => 1,
                  'assignee_user_id' => 1,
                  'status_id' => 2,
                  'order_num' => 3
              ],
              [
                  'subject' => 'あばばば',
                  'created_user_id' => 1,
                  'assignee_user_id' => 1,
                  'status_id' => 2,
                  'order_num' => 4
              ],
              [
                  'subject' => 'ふがふが',
                  'created_user_id' => 1,
                  'assignee_user_id' => 1,
                  'status_id' => 3,
                  'order_num' => 1
              ],
              [
                  'subject' => 'ああああ',
                  'created_user_id' => 1,
                  'assignee_user_id' => 1,
                  'status_id' => 3,
                  'order_num' => 2
              ]
          ]);
    }
}
