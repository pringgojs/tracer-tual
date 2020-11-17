
<div class="form-group">
    <label>Pertanyaan butuh logic ?</label>
    <div class="col-md-4">
        <div class="switch">
            <label>Tidak
                <input type="checkbox" value=1 name="is_logic" id="is-logic" onclick="showLogic()"><span class="lever"></span>Ya</label>
        </div>
    </div>
</div>

<div class="form-group bg-faded" style="display:none">
    <label for="">Tampilkan pertanyaan JIKA</label>
    <table id="table-logic" class="table table-responsive table-border" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th  width='450px'>Pertanyaan</th>
                <th  width='450px'>Tampilkan Jika Jawaban</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td><div class="btn btn-success btn-sm btn-circle" onclick="addRowTableLogic()" id="addRowTableLogic"><i class="fa fa-plus"></i></div></td>
            </tr>
        </tfoot>
    </table>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>