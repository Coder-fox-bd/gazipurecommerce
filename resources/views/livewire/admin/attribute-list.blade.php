<div>
    <!-- Attributes table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> Code </th>
                            <th> Name </th>
                            <th class="text-center"> Frontend Type </th>
                            <th class="text-center"> Filterable </th>
                            <th class="text-center"> Required </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th> Code </th>
                            <th> Name </th>
                            <th class="text-center"> Frontend Type </th>
                            <th class="text-center"> Filterable </th>
                            <th class="text-center"> Required </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($datas as $attribute)
                            <tr>
                                <td>{{ $attribute->code }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->frontend_type }}</td>
                                <td class="text-center">
                                    @if ($attribute->is_filterable == 1)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($attribute->is_required == 1)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
