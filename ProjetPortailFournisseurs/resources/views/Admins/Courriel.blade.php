@extends('Admins.Panel')

@section('content')

<div class="container">
    <h2 class="mb-4">Modèles de courriels</h2>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                <form id="emailForm" method="post" action="{{ route('NotificationTemplate.update') }}">
                    @csrf
                    <h5 class="card-title">Courriel</h5>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Sujet</label>
                            <input type="text" id="subject" class="form-control" value="">
                        </div>

                        <div class="mb-3">
                            <label for="line1" class="form-label">Ligne 1</label>
                            <input type="text" id="line1" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="line2" class="form-label">Ligne 2</label>
                            <input type="text" id="line2" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="line3" class="form-label">Ligne 3</label>
                            <input type="line3" id="line3" class="form-control" value="">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-success">Enregistrer les modifications</button>
                            <button class="btn btn-secondary">Annuler</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                    <form id="chooseTemplate" method="POST" action="{{route('NotificationTemplate.fetchTemplate')}}">
                    @csrf
                        <h5 class="card-title">Modèles</h5>
                        <div class="mb-3">
                            <select id="template" class="form-select" name="template_id">
                            <option disabled selected value="">Choisir un modèle</option>
                                @foreach ($templates as $template)
                                <option value="{{$template->id}}">{{$template->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary">Ajouter</button>
                            <button class="btn btn-danger">Supprimer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
console.log('Start');
$(document).ready(function (){
$('#template').on('change', function(){
console.log('Changed');
var templateId = $(this).val();

if (templateId){
$.ajax({
url: "{{route('NotificationTemplate.fetchTemplate')}}",
method: "POST",
data: {
_token: "{{ csrf_token() }}",
template_id: templateId
},
success: function (response) {
if (response.success) {

$('#subject').val(response.data.subject);
$('#line1').val(response.data.line1);
$('#line2').val(response.data.line2);
$('#line3').val(response.data.line3);
}
else {
alert(response.message);
}
},
error: function(){
alert('Une erreur est survenue lors de la requête des données.');
}
});
} else {
$('#subject').val('');
$('#line1').val('');
$('#line2').val('');
$('#line3').val('');
}
});
});
</script>

@endsection
