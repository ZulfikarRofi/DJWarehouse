@php($i = 1)
@foreach($result as $value)
<tr>
    <th scope="row">{{$i++}}</th>
    <td>
        <div class="d-flex justify-content-center">
            @if($value['image'] == null)
            <img src="/assets/img/no-pictures.png" alt="no images" style="width: 50%;">
            @else
            <img src="/image/{{$value['image']}}" alt="no images" style="width: 50%;">
            @endif
        </div>
    </td>
    <td class="text-center" style="text-transform: capitalize;">{{$value['name']}}</td>
    <td class="text-center" style="text-transform: capitalize;">{{$value['product_type']}}</td>
    <td class="text-center" style="text-transform: capitalize;">{{$value['colors']}}</td>
    <td class="text-center" style="text-transform: capitalize;">{{$value['size']}}</td>
    <td class="text-center" style="text-transform: capitalize;">{{$value['merk']}}</td>
    <td class="text-center"> Rp. {{number_format($value['sell_price'], 0 , ',' , '.')}},-</td>
    <td class="text-center">{{$value['stock']}} Pcs</td>
    <td>
        <div class="d-flex justify-content-center">
            <img src="/assets/img/edit.png" alt="edit" style="width:25%">
            <img class="ms-2" src="/assets/img/delete.png" alt="edit" style="width:25%" data-bs-toggle="modal" data-bs-target="#delete-{{$value['id']}}">
            <!-- Delete Product Modal -->
            <div class="modal fade" id="delete-{{$value['id']}}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin menghapus produk ini <span class="fw-bold">"{{$value['name']}}"</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form action="/deleteproduct/{{$value['id']}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- Delete Product Modal-->
        </div>
    </td>
</tr>
@endforeach