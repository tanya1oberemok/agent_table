@extends('reports.layout')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Report</h2>
        <div class="card-body">

            <form action="" method="GET">
                <div class="row mb-5">
                    <div class="col-xl-3">
                        <label>Decision date from</label>
                        <input type="date" name="decision_date_from" class="form-control" value="{{ $decision_date_from ?? '' }}">
                    </div>
                    <div class="col-xl-3">
                        <label>Decision date by</label>
                        <input type="date" name="decision_date_by" class="form-control" value="{{ $decision_date_by ?? '' }}">
                    </div>
                    <div class="col-xl-3">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>


            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>User Name</th>
                    @foreach($categories as $category)
                        <th>{{ $category->name }}</th>
                    @endforeach
                    <th>Total</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        @foreach($categories as $category)
                            @php $totalCategoryId = 'total_'.$category->id; @endphp
                            <td>{{ $user->$totalCategoryId }}</td>
                        @endforeach
                        <th>{{ $user->total }}</th>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">There are no data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {!! $users->links() !!}
        </div>
    </div>

@endsection

