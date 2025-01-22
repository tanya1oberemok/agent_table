<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $decision_date_by = $request->decision_date_by;
        $decision_date_from = $request->decision_date_from;
        $categories = Category::all();

        $usersQuery = User::query();

        if (!is_null($decision_date_from) && !is_null($decision_date_by)) {
            $usersQuery->whereHas('requisitions', function ($q) use ($decision_date_by, $decision_date_from) {
                $q->whereBetween('decision_date', [$decision_date_from, $decision_date_by]);
            });
        }

        $users = $usersQuery
            ->with('requisitions:id,user_id,category_id,decision_date')
            ->paginate(10);

        foreach ($users as $user) {
            $user->setAttribute('total', $user->requisitions->count());

            foreach ($categories as $category) {
                $user->setAttribute('total_'.$category->id, $user->requisitions->where('category_id', $category->id)->count());
            }
        }


        return view('reports.index', [
            'users' => $users,
            'categories' => $categories,
            'decision_date_by' => $decision_date_by,
            'decision_date_from' => $decision_date_from,
        ])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
