@if ($cart)
@foreach ($cart as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->barang->id }}</td>
    <td>{{ $item->barang->nama }}</td>
    <td>{{ $item->price }}</td>
    <td class="text-center">{{ $item->qty }} </label></td>
    <td width="15%" id="total">{{ $item->subtotal }}</td>
    <td>
        <button class="btn btn-warning btn-change-qty" data-change="decrement" data-id="{{ $item->id }}"><i
                class="fa fa-minus"></i></button>
        <button class="btn btn-success btn-change-qty" data-change="increment" data-id="{{ $item->id }}"><i
                class="fa fa-plus"></i></button>
        <button class="btn btn-danger btn-hapus" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="9" class="text-center">Tidak ada item</td>
</tr>
@endif