<div id="modal-voter" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="modal-title" class="modal-title"><strong></strong></h3>
            </div>

            <div class="modal-body row">

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-building-o"></i> <strong class="hidden-xs">Puesto: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-polling-station"></spam> </h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-building-o"></i> <strong class="hidden-xs">Día D: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-polling-station-day-d"></spam> </h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-phone"></i> <strong class="hidden-xs">Celular: </strong></h4>
                    <a href="" id="modal-a-telephone">    
                        <h4 class="col-sm-8 col-xs-10"><spam id="modal-telephone"></spam> </h4>
                    </a>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-home"></i> <strong class="hidden-xs">Dirección: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-place-address"></spam></h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="gi gi-old_man"></i> <strong class="hidden-xs">Cargos: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-roles"></spam> </h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-send-o"></i> <strong class="hidden-xs">Correo: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-email"></spam> </h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-birthday-cake"></i> <strong class="hidden-xs">Cumpleaños: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-birhtday"></spam> </h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-street-view"></i> <strong class="hidden-xs">Ocupación: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-occupation"></spam> </h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-users"></i> <strong class="hidden-xs">Comunidades: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-communities"></spam> </h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-sitemap"></i> <strong class="hidden-xs">Referido por: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-superior"></spam> </h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-calendar-o"></i> <strong class="hidden-xs">Notas: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-description"></spam> </h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="hi hi-stats"></i> <strong class="hidden-xs">Referidos: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><spam id="modal-refers"></spam> </h4>
                </div>

                <div class="col-xs-12">
                    <h4 class="col-sm-4 col-xs-2"><i class="fa fa-file-text-o"></i> <strong class="hidden-xs">Eventos: </strong></h4>
                    <h4 class="col-sm-8 col-xs-10"><a id="modal-diaries" href="#"></a> </h4>
                </div>

            </div>

            <div class="modal-footer">
                <a href="#" id="modal-edit" data-toggle="tooltip" title="Editar Votante" class="btn btn-effect-ripple btn-info">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="#" id="modal-in" data-toggle="tooltip" title="Agregar al Equipo" class="btn btn-effect-ripple btn-success">
                    <i class="fa fa-user-plus"></i>
                </a>
                <a href="#" id="modal-out" data-toggle="tooltip" title="Sacar del Equipo" class="btn btn-effect-ripple btn-warning">
                    <i class="fa fa-exclamation-triangle"></i>
                </a>
                @if(isset($diary))
                    <a href="#" id="modal-diary-remove" data-toggle="tooltip" title="Sacar de la Asistencia" data-dismiss="modal" class="btn btn-effect-ripple btn-danger">
                        <i class="gi gi-cart_out"></i>
                    </a>
                @endif
                @if(Auth::user()->hasModule('delete-voters'))
                    <a href="#" id="modal-delete" data-toggle="tooltip" title="Borrar Votante" data-dismiss="modal" class="btn btn-effect-ripple btn-danger">
                        <i class="fa fa-times"></i>
                    </a>
                @endif
            </div>  
        </div>
    </div>
</div>