@props(['cardTitle'=>'','cardTools'=>'','cardFooter'=>''])
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title m-0">{{$cardTitle}}</h3>
            <div class="card-tools ml-auto"> 
                {{$cardTools}}
            </div>
    </div>
    <div class="card-body">
        {{$slot}}
    </div>
    <div class="card-footer">
        <div class="float-right"> <!-- clase para que flote hacia la derecha-->
            {{$cardFooter}}
        </div>
    </div>
</div>