@extends('admin.layout.app')

@section('content')
<div class="container">
    <h1 class="mb-4">
        <i class="fas fa-trash-restore text-warning"></i> Trash Management
    </h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <ul class="nav nav-tabs card-header-tabs">
                @foreach([
                    'Product' => $trashedProducts,
                    'Category' => $trashedCategories,
                    'Brand' => $trashedBrands,
                    'Admin' => $trashedAdmins,
                    'Supplier' => $trashedSuppliers,
                    'Purchase' => $trashedPurchases,
                    'Sale' => $trashedSales,
                    'SaleItem' => $trashedSaleItems,
                ] as $modelName => $items)
                    @if($items->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" 
                               data-toggle="tab" 
                               href="#tab-{{ $modelName }}">
                                {{ $modelName }}s
                                <span class="badge badge-danger ml-1">{{ $items->count() }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content">
                @foreach([
                    'Product' => $trashedProducts,
                    'Category' => $trashedCategories,
                    'Brand' => $trashedBrands,
                    'Admin' => $trashedAdmins,
                    'Supplier' => $trashedSuppliers,
                    'Purchase' => $trashedPurchases,
                    'Sale' => $trashedSales,
                    'SaleItem' => $trashedSaleItems,
                ] as $modelName => $items)
                    @if($items->count() > 0)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $modelName }}">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name/Title</th>
                                            <th>Deleted At</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    {{ $item->name ?? $item->title ?? $item->invoice_number ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    <span class="badge badge-secondary">
                                                        {{ $item->deleted_at->format('M d, Y h:i A') }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('trash.restore', ['model' => $modelName, 'id' => $item->id]) }}" 
                                                           class="btn btn-sm btn-outline-success"
                                                           onclick="event.preventDefault();
                                                                    document.getElementById('restore-form-{{ $modelName }}-{{ $item->id }}').submit();">
                                                            <i class="fas fa-trash-restore"></i> Restore
                                                        </a>
                                                        
                                                        <form id="restore-form-{{ $modelName }}-{{ $item->id }}" 
                                                              action="{{ route('trash.restore', ['model' => $modelName, 'id' => $item->id]) }}" 
                                                              method="POST" 
                                                              style="display: none;">
                                                            @csrf
                                                        </form>
                                                        
                                                        <button class="btn btn-sm btn-outline-danger" 
                                                                data-toggle="modal" 
                                                                data-target="#deleteModal-{{ $modelName }}-{{ $item->id }}">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </div>
                                                    
                                                    <!-- Delete Confirmation Modal -->
                                                    <div class="modal fade" id="deleteModal-{{ $modelName }}-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger text-white">
                                                                    <h5 class="modal-title">Confirm Permanent Deletion</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to permanently delete this {{ strtolower($modelName) }}?
                                                                    <br><strong>This action cannot be undone!</strong>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <form action="{{ route('trash.forceDelete', ['model' => $modelName, 'id' => $item->id]) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <i class="fas fa-trash-alt"></i> Delete Permanently
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    @if($trashedProducts->isEmpty() && 
        $trashedCategories->isEmpty() && 
        $trashedBrands->isEmpty() && 
        $trashedAdmins->isEmpty() && 
        $trashedSuppliers->isEmpty() && 
        $trashedPurchases->isEmpty() && 
        $trashedSales->isEmpty() && 
        $trashedSaleItems->isEmpty())
        <div class="alert alert-info text-center py-4">
            <i class="fas fa-trash fa-2x mb-3"></i>
            <h4>Your trash bin is empty</h4>
            <p class="mb-0">No deleted items found</p>
        </div>
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

@endsection