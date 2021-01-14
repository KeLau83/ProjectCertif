<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramRequest;
use App\Models\Program;
use Illuminate\Routing\Controller as BaseController;

class ProgramController extends BaseController
{

    public function store(ProgramRequest $request)
    {
        $program = Program::create($request->validated());
        return;
    }

    public function update(ProgramRequest $request, int $id)
    {
        if ($request->validated()) {
            $program = Program::where('id', $id)->first();
            if ($program) {
                $program->user_id = $request->user_id;
                $program->category_id =  $request->category_id;
                $program->name =  $request->name;
                $program->description =  $request->description;
                $program->type =  $request->description;
                $program->nbr_time =  $request->nbr_time;
                $program->save();
                return ;
            }
        }
    }

    public function delete(int $id)
    {
        $user = Program::where('id', $id)->first()
                    ->delete();
    }

    
    public function test(ProgramRequest $request)
    {   
        $data = [
            'user_id' => 1,
            'category_id' => 1,
            'name' => ' $this->faker->name',
            'description' => '-> ',
        ];
        $program = Program::create($data);
        return;
    }
}