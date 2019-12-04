<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function it_lists_all_questions()
    {
        factory('App\Models\Question', 2)->create();
        $response = $this->json('GET', route('questions.index'));
        $response->assertOk();
        $response->assertJsonCount(2, 'data');
        $response->assertJsonStructure(['data', 'pagination']);
    }

    /**
     * @test
     */
    public function it_shows_details_of_a_question()
    {
        $user = factory('App\Models\User')->create();
        $this->authenticate($user);

        $question = factory('App\Models\Question')->create([
            'user_id' => $user,
            'title' => 'The night of power',
        ]);

        $response = $this->json('GET', route('questions.show', $question));
        $response->assertOk();
        $response->assertJsonFragment([
            'title' => 'The night of power',
        ]);
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_ask_a_question()
    {
        $user = factory('App\Models\User')->create();
        $this->authenticate($user);

        $input = [
            'title' => 'Fasting in Ramadan',
            'description' => 'Who is it mandatory upon to fast the full month of Ramadan?'
        ];

        $response = $this->json('POST', route('questions.store'), $input);
        $response->assertStatus(201);
        $this->assertDatabaseHas('questions', [
            'description' => 'Who is it mandatory upon to fast the full month of Ramadan?',
            'user_id' => $user->id,
        ]);
        $response->assertJsonFragment([
            'description' => 'Who is it mandatory upon to fast the full month of Ramadan?'
        ]);
    }

    /**
     * @test
     */
    public function an_authorized_user_can_update_a_question()
    {
        $user = factory('App\Models\User')->create();
        $this->authenticate($user);

        $question = factory('App\Models\Question')->create([
            'user_id' => $user,
            'title' => 'Fasting in Ramadan',
        ]);

        $input = [
            'title' => 'Fasting in the month of Ramadan.',
        ];

        $response = $this->json('PATCH', route('questions.update', $question), $input);
        $response->assertOk();
        $this->assertDatabaseHas('questions', [
            'title' => 'Fasting in the month of Ramadan.',
        ]);
    }

    /**
     * @test
     */
    public function an_authorized_user_can_soft_delete_a_question()
    {
        $user = factory('App\Models\User')->create();
        $this->authenticate($user);

        $question = factory('App\Models\Question')->create([
            'user_id' => $user,
            'title' => 'Shafi & Witr',
        ]);

        $response = $this->json('DELETE', route('questions.destroy', $question));
        $this->assertSoftDeleted('questions', ['id' => $question->id]);
        $response->assertNoContent();
    }

    /**
     * @test
     */
    public function an_authorized_user_can_delete_a_question_permanently()
    {
        $user = factory('App\Models\User')->create();
        $this->authenticate($user);

        $question = factory('App\Models\Question')->create([
            'user_id' => $user,
            'title' => 'Shafi & Witr',
        ]);

        $input = ['permanent' => true];

        $response = $this->json('DELETE', route('questions.destroy', $question), $input);
        $this->assertDatabaseMissing('questions', ['id' => $question->id]);
        $response->assertNoContent();
    }
}
