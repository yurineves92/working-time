<form action="{{ route('reports') }}" method="GET">
    <div class="col-md-3">
        <label>Work Date</label>
        <input type="date" class="form-control" name="work_date" value=""/>
        <button type="submit" class="btn btn-primary mt-3">Search</button>
    </div>
</form>