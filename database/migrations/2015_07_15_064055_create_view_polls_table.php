<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement( 'CREATE VIEW view_polls AS '.
            'SELECT polls.id as poll_id, polls.name as poll_name, user.id as user_id, user.username as user_username, user.name as user_name,'. 
            'voters.id as voter_id, voters.doc as voter_doc, voters.name as voter_name, questions.id as question_id, questions.text as question_text,'. 
            'questions.type as question_type, answers.id as answer_id, answers.text as answer_text, voter_polls.id, voter_polls.observation,'.
            'voter_polls.result, voter_polls.created_at '.
            'FROM polls '.
            'JOIN voter_polls ON '.
                'voter_polls.poll_id = polls.id '.
            'JOIN answer_voter_poll ON '.
                'answer_voter_poll.voter_poll_id = voter_polls.id '.
            'JOIN answers ON '.
                'answer_voter_poll.answer_id = answers.id '.
            'JOIN questions ON '.
                'answers.question_id = questions.id '.
            'JOIN voters ON '.
                'voters.id = voter_polls.voter_id '.
            'JOIN user ON '.
                'user.id = voter_polls.user_id'
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        DB::statement( 'DROP VIEW view_polls' );
    }

}
