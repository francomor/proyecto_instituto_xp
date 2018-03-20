<?php     
  include_once("GUIPreceptor.class.php");
  $gui_preceptor = new GUIPreceptor();
  
?>
  
	<div class="content-wrapper">
 
    <section class="content-header">
      <h1>
      	  CURSOS
        <small> </small>
      </h1> 
       <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Cursos</a></li>
        <li class="active">Lista</li>
      </ol>
    </section>
    
   
   <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <div class="container">




       <div class="panel-heading ">
       
       <!-- Button trigger modal -->
        <button type="button " class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
          Agregar curso
        </button>
 
     </div>
      

      
      <div class="panel-body">
        <form class="form-horizontal" role="form" id="datos_pedido">
        
          <div class="form-group row">
           
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
          </div>  

          <div>
            <h4><i class='glyphicon glyphicon-list'></i> Lista  </h4> 
          </div>
          </form>  
      </div>
    </div>  


                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
  </section>

 
</div>
   


<?php     
  $gui_preceptor->cargarFooter();
?>
  