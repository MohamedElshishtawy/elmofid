@extends('educator.layout.dashboard')

@php($active = 'pdf')
@section('title', 'إدارة الطلاب')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css")}}">
    <link rel="stylesheet" href="{{asset("css/content/form.css")}}">
@endsection
@section('content')
    <form action="{{route('save_edit_pdf', [$class, $pdf['id']])}}"  class="form" method="post" enctype="multipart/form-data">
        @csrf

        <h2>إضافة PDF</h2>

        <div class="form-group mt-5">
            <label for="name">العنوان</label>
          <input type="text" class="form-control" id="code" name="name" placeholder="عنوان ليتمكن الطالب من تمييز المذكرات" value="{{old('name', $pdf['name'])}}" required>
          @error('name')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>


        <div class="form-group">
            <label for="name">صف المجموعة</label>
            <select name="class" class="form-control form-select" id="class" disabled>
                <option value="0">حدد الصف</option>
                <option value="1" {{old('class', $class)==1 ?'selected':''}}>الصف الأول</option>
                <option value="2" {{old('class', $class)==2 ?'selected':''}}>الصف الثانى</option>
                <option value="3" {{old('class', $class)==3 ?'selected':''}}>الصف الثالث</option>
            </select>
          @error('class')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>


        <div class="row g-2 mt-5">

      	  <div class="col-md">
      	    <div class="form-floating">
      	      <input type="url" name="pdf_url" class="form-control" id="floatingInputGrid" placeholder="https://..." value="{{old('pdf_url', $pdf['link'])}}" disabled>
      	      <label for="floatingInputGrid">رابط خارجى</label>
      	    </div>
            @error('pdf_url')
              <small class="form-text text-muted text-danger">{{$message}}</small>
            @enderror
      	  </div>

      	  <div class="col-md">
      	    <div class="form-floating">
      	      <input type="file" name="pdf" class="form-control" id="pdf" disabled>
      	      <label for="floatingSelectGrid">ملف على الجهاز</label>
      	    </div>
            @error('pdf')
              <small class="form-text text-muted text-danger">{{$message}}</small>
            @enderror
      	  </div>

	       </div>

        <div class="mt-3">

            <div>
                <label class="exam-txt">  الفترة المتاحة</label>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="datetime-local" name="start_date" id="start_date" class="date-input form-control" value="{{old('start_date', $pdf['start_date'])}}">
                        <label for="start_date">من تاريخ</label>
                    </div>
                    @error('start_date')
                    <small class="txt-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        <input type="datetime-local" name="end_date" id="end_date" class="date-input form-control" value="{{old('end_date', $pdf['end_date'])}}">
                        <label for="end_date">الى</label>
                    </div>
                    @error('end_date')
                    <small class="txt-danger">{{$message}}</small>
                    @enderror
                </div>

            </div>
        </div>

        <div class="text-center text-lg">
            <div class="switch-container">
                <div class="switch">
                    <input class="switch-input" name="availability" type="checkbox" id="degree_show" {{ old('availability', $pdf['availability  ']) == 'on' || old('availability', $pdf['availability']) == 1 ? 'checked' : '' }}>
                    <label class="switch-label" for="degree_show">مرئي للطلاب</label>
                    <br>

                </div>
                <label for="degree_show">مرئي للطلاب</label>
                @error('availability')
                <small class="txt-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>



         <div class="form-check form-switch mt-3">

           <label class="form-check-label mr-3" for="flexSwitchCheckDefault">مرئي للطلاب</label>
           @error('availability')
             <small class="form-text text-muted text-danger">{{$message}}</small>
           @enderror
         </div>


        <button type="submit" class="btn btn-primary mt-5">تعديل</button>
      </form>



@endsection
