<?php
/**
 * @group Projects
 * Manages Projects
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectAddNewRequest;
use App\Models\Project;
use App\Http\Resources\Project as ProjecrResource;

class ProjectsController extends Controller
{
    /**
     * Create a new ProjectsController instance.
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
     * @return App\Http\Resources\Project
     */
    public function add_new(ProjectAddNewRequest $request)
    {
    	$project = Project::create($request->all());
        return new ProjecrResource($project);
    }
    /**
     * Get project list
     * @return App\Http\Resources\Project
     */
    public function list()
    {
        return ProjecrResource::collection(Project::all());
    }
    /**
     * Get single project detail
     * @urlParam id int required
     * @return App\Http\Resources\Project
     */
    public function details($id)
    {
        return new ProjecrResource(Project::find($id));
    }
    /**
     * Uodate project detail
     * @urlParam id int required
     * @bodyParam name strine required
     * @bodyParam description text required
     * @bodyParam client string required
     * @bodyParam deadline date
     * @return App\Http\Resources\Project
     */
    public function update($id, Request $request)
    {
        $project = Project::find($id);
        if(isset($request->name) && $request->name != null){
            $project->name = $request->name;
        }
        if(isset($request->description) && $request->description != null){
            $project->description = $request->description;
        }
        if(isset($request->client) && $request->client != null){
            $project->client = $request->client;
        }
        if(isset($request->deadline) && $request->deadline != null){
            $project->deadline = $request->deadline;
        }
        $project->save();
        return new ProjecrResource($project);
    }
}
