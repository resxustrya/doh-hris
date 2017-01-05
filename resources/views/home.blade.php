@extends('layouts.app')

@section('content')
<div class="col-md-12 wrapper">
    <div class="alert alert-jim">
        <h3 class="page-header">Employee Attendance
        </h3>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(isset($lists) and count($lists) >0)
                        <div class="table-responsive">
                            <table class="table table-list table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Userid</th>
                                    <th>Name</th>
                                    <th>Transaction date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $list)
                                    <?php $section = \App\Section::where('id', $user->section)->pluck('description')->first(); ?>
                                    <?php $division = \App\Division::where('id', $user->division)->pluck('description')->first(); ?>
                                    <?php $designation = \App\Designation::where('id', $user->designation)->pluck('description')->first(); ?>

                                    <tr>
                                        <td><a href="#user" data-id="{{ $user->id }}" data-link="{{ asset('user/edit') }}" class="title-info">{{ $user->username }}</a></td>
                                        <td><a href="#user" data-id="{{ $user->id }}" data-link="{{ asset('user/edit') }}" class="text-bold">{{ $user->fname ." ". $user->mname." ".$user->lname }}</a></td>
                                        <td>{{ $designation }}</td>
                                        <td>
                                            {{ $section }}<br>
                                            <em>({{ $division }})</em>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#user" class="btn btn-sm btn-info" data-toggle="modal" data-link="{{ asset('user/edit') }}" data-id="{{ $user->id }}">
                                                    <i class="fa fa-pencil"></i>  Update
                                                </a>
                                            </div>
                                            <button type="button" data-id="{{ $user->id }}" data-link="{{ asset('user/remove') }}" class="btn btn-danger" id="delete_user" onclick="del_user(this);" name="delete" value="delete" ><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $users->links() }}
                        @endforeach
                    @else
                        <div class="alert alert-danger" role="alert">DTR records are empty.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('resources/plugin/Chart.js/Chart.min.js') }}"></script>
<script>

</script>

@endsection