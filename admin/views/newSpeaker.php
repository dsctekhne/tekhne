
    <section class="content-header text-center">
      <h1>
        <i class="fas fa-user-plus"></i>&nbsp&nbsp&nbsp
        Nuevo Ponente
      </h1>
    </section>
    <section class="content container-fluid">
    <div class="box box-success"> 
      <div class="box-body">
        <form action="../../web_services/speakers/newSpeakerService.php" method="post">
          <div class="form-group">
            <label for="name">Nombre:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-user"></i></span>
              <input id="input-name" type="text" class="form-control" name="name"
                placeholder="Introduce el nombre del ponente" maxlength="50"
                pattern="[a-zA-ZÀ-ž\s]+" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="paternal_surname">Apellido Paterno:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-user"></i></span>
              <input id="input-paternal_surname" type="text" class="form-control" name="paternal_surname"
                placeholder="Introduce el apellido paterno del ponente" maxlength="50"
                pattern="[a-zA-ZÀ-ž\s]+" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="maternal_surname">Apellido Materno:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-user"></i></span>
              <input id="input-maternal_surname" type="text" class="form-control" name="maternal_surname"
                placeholder="Introduce el apellido materno del ponente" maxlength="50"
                pattern="[a-zA-ZÀ-ž\s]+" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="information">Información del ponente:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-user"></i></span>
              <textarea id="input-information" class="form-control" name="information"
                placeholder="Introduce información relevante del ponente" maxlength="500"
                pattern="[a-zA-ZÀ-ž\s]+"></textarea>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" value="Registrar ponente" class="btn btn-success">
          </div>
        </form>
      </div>
    </div>
    </section>