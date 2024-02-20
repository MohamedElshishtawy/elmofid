<div>
    <div class="form-group">
        <label for="class">الصف</label>
        <select wire:model.live="_class" name="class" class="form-control form-select" id="class">
            <option value="0">حدد الصف</option>
            <option value="1" {{$_class == 1 ? 'selected' : ''}}>الصف الأول</option>
            <option value="2" {{$_class == 2 ? 'selected' : ''}}>الصف الثانى</option>
            <option value="3" {{$_class == 3 ? 'selected' : ''}}>الصف الثالث</option>
        </select>
        @error('_class')
            <small class="form-text text-muted text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="group">المجموعة</label>
        <select name="group" class="form-control form-select" id="group">
            @forelse ($groups as $group_)
                <option value="{{$group_->id}}">{{$group_->name}}</option>
            @empty
                <option value="0">إختر المجموعة</option>
            @endforelse
        </select>
        @error('group')
            <small class="form-text text-muted text-danger">{{$message}}</small>
        @enderror
    </div>
</div>
