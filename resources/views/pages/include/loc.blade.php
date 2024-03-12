<form>
    @csrf
<div class="col-md-4">
            <label for="amount" >Sắp Xếp Theo</label>
            
                <select name="sort" id="sort" class="form-control" style="margin:10px">
                    <option value="{{Request::url()}}?sort_by=none">------Lọc------</option>
                    <option value="{{Request::url()}}?sort_by=tang_dan">-----Giá Tăng Dần-----</option>
                    <option value="{{Request::url()}}?sort_by=giam_dan">-----Giá Giảm Dần-----</option>
                    <option value="{{Request::url()}}?sort_by=kytu_az">Lọc Theo Tên Từ A -> Z</option>
                    <option value="{{Request::url()}}?sort_by=kytu_za">Lọc Theo Tên Từ Z -> A</option>
                </select>
           
        </div>
    </form>