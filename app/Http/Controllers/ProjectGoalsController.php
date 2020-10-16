<?php
/**
 * @group Project Goals
 * Manages Project  Goals
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectGoalsAddNewRequest;
use App\Models\ProjectGoals;
use App\Http\Resources\ProjectGoals as ProjectGoalsResource;

class ProjectGoalsController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Add new project in the system
     * @bodyParam name strine required
     * @bodyParam description text required
     * @bodyParam client string required
     * @bodyParam deadline date
     * @return App\Http\Resources\ProjectGoals
     */
    public function add_new(ProjectGoalsAddNewRequest $request)
    {
    	$projectGoal = ProjectGoals::create($request->all());
        return new ProjectGoalsResource($projectGoal);
    }
    /**
     * Get project list
     * @return App\Http\Resources\ProjectGoals
     */
    public function list()
    {
        return ProjectGoalsResource::collection(ProjectGoals::all());
    }
    /**
     * Get single project detail
     * @urlParam id int required
     * @return App\Http\Resources\ProjectGoals
     */
    public function details($id)
    {
        return new ProjectGoalsResource(ProjectGoals::find($id));
    }
    /**
     * Uodate project detail
     * @urlParam id int required
     * @bodyParam name strine required
     * @bodyParam description text required
     * @bodyParam client string required
     * @bodyParam deadline date
     * @return App\Http\Resources\ProjectGoals
     */
    public function update($id, Request $request)
    {
        $projectGoal = ProjectGoals::find($id);
        if(isset($request->name) && $request->name != null){
            $projectGoal->name = $request->name;
        }
        if(isset($request->description) && $request->description != null){
            $projectGoal->description = $request->description;
        }
        if(isset($request->client) && $request->client != null){
            $projectGoal->client = $request->client;
        }
        if(isset($request->deadline) && $request->deadline != null){
            $projectGoal->deadline = $request->deadline;
        }
        $projectGoal->save();
        return new ProjectGoalsResource($projectGoals);
    }
}
