<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Git\PullRequest;
use App\Http\Requests\Git\CloneRequest;
use App\Http\Requests\Git\CheckoutRequest;
use App\Http\Requests\Git\StashRequest;
use App\Services\Git\CloneServicesGit;
use App\Services\Git\PullServicesGit;
use App\Services\Git\CheckoutServicesGit;
use App\Services\Git\StashServicesGit;
use App\Services\Shell\ExecServicesShell;
use Illuminate\Routing\Controller;

class GitController extends Controller
{
    public function __construct(ExecServicesShell $execServicesShell)
    {
        $this->execServicesShell = $execServicesShell;
    }

    public function clone(CloneRequest $request)
    {
        $CloneRepositoryServicesGit = new CloneServicesGit();

        $command = $CloneRepositoryServicesGit->cloneRepository($request->path,$request->repository,$request->branche);
        $output = $this->execServicesShell->exec($command);

        return response()->json($output,200);
    }

    public function pull(PullRequest $request)
    {
        $PullRepositoryServicesGit = new PullServicesGit();

        $command = $PullRepositoryServicesGit->pullRepository($request->path,$request->repository,$request->branche);
        $output = $this->execServicesShell->exec($command);

        return response()->json($output,200);
    }

    public function checkout(CheckoutRequest $request)
    {
        $CheckoutServicesGit = new CheckoutServicesGit();
        $command = $CheckoutServicesGit->checkoutRepository($request->path,$request->branche);
        $output = $this->execServicesShell->exec($command);

        return response()->json($output,200);
    }

    public function stash(StashRequest $request)
    {
        $StashServicesGit = new StashServicesGit();
        $command = $StashServicesGit->stash($request->path,$request->repository,$request->branche);
        $output = $this->execServicesShell->exec($command);

        return response()->json($output,200);
    }

    public function stashPop(StashRequest $request)
    {
        $StashServicesGit = new StashServicesGit();
        $command = $StashServicesGit->stashPop($request->path,$request->repository,$request->branche);
        $output = $this->execServicesShell->exec($command);

        return response()->json($output,200);
    }

}
