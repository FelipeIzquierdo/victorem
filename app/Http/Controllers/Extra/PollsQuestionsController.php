<?php namespace Victorem\Http\Controllers\Extra;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Victorem\Http\Requests\Poll\Question\CreateRequest;
use Victorem\Http\Requests\Poll\Question\EditRequest;

use Victorem\Entities\Poll;
use Victorem\Entities\Question;
use Victorem\Entities\Answer;

use Victorem\Http\Controllers\Controller;

use Illuminate\Database\QueryException;

class PollsQuestionsController extends Controller
{
    private $question;
    private $poll;
    private $form_data;

    public function __construct() 
    {
        $this->beforeFilter('@findPoll', ['only' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
        $this->beforeFilter('@findQuestion', ['only' => ['edit', 'update', 'show', 'destroy']]);
        $this->beforeFilter('@newQuestion', ['only' => ['create', 'store']]);

        $this->middleware('logs', ['only' => ['store', 'update', 'destroy']]);
    }

    private function getFormView()
    {
        return view('dashboard.pages.polls.question')
            ->with(['question' => $this->question, 'poll' => $this->poll, 'form_data' => $this->form_data]);
    }

    private function saveQuestion($data)
    {
        $this->question->fill($data);
        $this->question->save();

        if(array_key_exists('answer', $data))
        {
            foreach ($data['answer'] as $key => $text) {
                $answer = $this->question->answers()->findOrFail($key);
                $answer->text = $text;
                $answer->save();
            }
        }

        if(array_key_exists('new_answers', $data) && !empty($data['new_answers']))
        {
            $answers = explode(",", $data['new_answers']);
            foreach ($answers as $text) 
            {
                $newAnswer = Answer::firstOrCreate([
                    'question_id'   => $this->question->id, 
                    'text'          => trim($text)
                ]);
            }
        }

        return redirect()->route('polls.show', [$this->poll->id]);
    }

    /**
     * A new instance of poll
     *
     */
    public function newQuestion()
    {
        $this->question = new Question(['poll_id' => $this->poll->id]);
    }

    /**
     * Find a specified resource
     *
     */
    public function findQuestion(Route $route)
    {
        $this->question = $this->poll->questions()->findOrFail($route->getParameter('questions'));
    }

    /**
     * Find a specified resource
     *
     */
    public function findPoll(Route $route)
    {
        $this->poll = Poll::findOrFail($route->getParameter('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($poll_id)
    {
        $this->form_data = ['route' => ['polls.questions.store', $this->poll->id], 'method' => 'POST'];

        return $this->getFormView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($poll_id, CreateRequest $request)
    {
        return $this->saveQuestion($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->form_data = ['route' => ['polls.questions.update', $this->poll->id, $this->question->id], 'method' => 'PUT'];

        return $this->getFormView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, EditRequest $request)
    {
        return $this->saveQuestion($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($poll_id, $id, Request $request)
    {        
        try {
            $this->question->delete();
            $result = array('msg' => 'Pregunta eliminada exitosamente', 'success' => true, 'id' => $id);
        } catch (QueryException $e) {
            $result = ['msg' => 'Solo se puede borrar una Pregunta que no se haya utilizado', 
                'success' => false, 'id' => $this->question->id];
        }

        if ($request->ajax())
        {
            return $result;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function answersDestroy($id, Request $request)
    {
        $answer = Answer::findOrFail($id);
        
        try {
            $answer->delete();
            $result = array('msg' => 'Respuesta eliminada exitosamente', 'success' => true, 'id' => $id);
        } catch (QueryException $e) {
            $result = ['msg' => 'Solo se puede borrar una Respuesta que no se haya utilizado', 
                'success' => false, 'id' => $answer->id];
        }

        if ($request->ajax())
        {
            return $result;
        }
    }
}
