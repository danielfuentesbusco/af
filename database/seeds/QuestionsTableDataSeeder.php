<?php

use Illuminate\Database\Seeder;

class QuestionsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
			'question' => '¿Qué te gustaría que agregáramos al informe?',
			'answers' => '<textarea name="question_1" class="form-control"></textarea>'
		]);
		
		DB::table('questions')->insert([
			'question' => '¿La información es correcta?',
			'answers' => '<label class="radio-inline"><input type="radio" name="question_2" value="SI" > Si</label>
							<label class="radio-inline"><input type="radio" name="question_2" value="NO"> No</label>
							<label class="radio-inline"><input type="radio" name="question_2" value="Más o Menos"> Más o menos</label>'
		]);
		
		DB::table('questions')->insert([
			'question' => '¿Del 1 al 5, es rápido el sitio?',
			'answers' => '<label class="radio-inline"><input type="radio" name="question_3" value="1"> 1</label>
							<label class="radio-inline"><input type="radio" name="question_3" value="2"> 2</label>
							<label class="radio-inline"><input type="radio" name="question_3" value="3"> 3</label>
							<label class="radio-inline"><input type="radio" name="question_3" value="4"> 4</label>
							<label class="radio-inline"><input type="radio" name="question_3" value="5"> 5</label>'
		]);
    }
}
