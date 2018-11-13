<?php

function getEncargoByid($db, $id){
    $sql ="SELECT * FROM encargo where id = $id;";
    $result = $db->query($sql);
    $res = array();
    while ($row = $result->fetch_assoc()) {
        $res[] = $row;
    }
    return $res;
}

function getViajes($db){
    $sql ="SELECT * FROM viaje";
    $result = $db->query($sql);
    $res = array();
    while ($row = $result->fetch_assoc()) {
        $res[] = $row;
    }
    return $res;
}

function getEncargos($db){
    $sql ="SELECT * FROM encargo";
    $result = $db->query($sql);
    $res = array();
    while ($row = $result->fetch_assoc()) {
        $res[] = $row;
    }
    return $res;
}

function getPesos($db){
	$sql ="SELECT id, valor FROM espacio_encargo";
	$result = $db->query($sql);
	$res = array();
	while ($row = $result->fetch_assoc()) {
		$res[] = $row;
	}
	return $res;
}

function getKilos($db){
    $sql ="SELECT id, valor FROM kilos_encargo";
    $result = $db->query($sql);
    $res = array();
    while ($row = $result->fetch_assoc()) {
        $res[] = $row;
    }
    return $res;
}

function getRegion($db){
    $sql ="SELECT region.id, region.nombre FROM region";
    $result = $db->query($sql);
    $res = array();
    while ($row = $result->fetch_assoc()) {
        $res[] = $row;
    }
    return $res;
}

function getComunas($db,$id_region){
    $sql ="SELECT comuna.id, comuna.nombre FROM comuna where comuna.region_id = '$id_region'";
    $result = $db->query($sql);
    $res = array();
    while ($row = $result->fetch_assoc()) {
        $res[] = $row;
    }
    return $res;
}

function resetDB($db){
    $sql ="drop table encargo;";
    $db->query($sql);
    resetEncargos($db);
    $sql ="drop table viaje;";
    $db->query($sql);
    resetViajes($db);

}

function resetViajes($db){
    $sql ="CREATE TABLE IF NOT EXISTS `cc500213_db`.`viaje` (
            `id` INT NOT NULL,
            `fecha_ida` DATETIME NOT NULL,
            `fecha_regreso` DATETIME NOT NULL,
            `origen` INT NOT NULL,
            `destino` INT NOT NULL,
            `kilos_disponible` INT NOT NULL,
            `espacio_disponible` INT NOT NULL,
            `email_viajero` VARCHAR(30) NOT NULL,
            `celular_viajero` VARCHAR(15) NULL,
            PRIMARY KEY (`id`),
            INDEX `kilos_fk_idx` (`kilos_disponible` ASC),
            INDEX `espacio_fk_idx` (`espacio_disponible` ASC),
            INDEX `fk_viaje_comuna1_idx` (`origen` ASC),
            INDEX `fk_viaje_comuna2_idx` (`destino` ASC),
            CONSTRAINT `kilos_fk`
              FOREIGN KEY (`kilos_disponible`)
              REFERENCES `cc500213_db`.`kilos_encargo` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `espacio_fk`
              FOREIGN KEY (`espacio_disponible`)
              REFERENCES `cc500213_db`.`espacio_encargo` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `fk_viaje_comuna1`
              FOREIGN KEY (`origen`)
              REFERENCES `cc500213_db`.`comuna` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `fk_viaje_comuna2`
              FOREIGN KEY (`destino`)
              REFERENCES `cc500213_db`.`comuna` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION)
            ENGINE = InnoDB;";
    $db->query($sql);
}

function resetEncargos($db){
    $sql ="CREATE TABLE IF NOT EXISTS `cc500213_db`.`encargo` (
            `id` INT NOT NULL,
            `descripcion` VARCHAR(100) NOT NULL,
            `origen` INT NOT NULL,
            `destino` INT NOT NULL,
            `espacio` INT NOT NULL,
            `kilos` INT NOT NULL,
            `foto` VARCHAR(300) NOT NULL,
            `email_encargador` VARCHAR(30) NOT NULL,
            `celular_encargador` VARCHAR(15) NULL,
            PRIMARY KEY (`id`),
            INDEX `espacio_e_fk_idx` (`espacio` ASC),
            INDEX `kilos_e_fk_idx` (`kilos` ASC),
            INDEX `fk_encargo_comuna1_idx` (`origen` ASC),
            INDEX `fk_encargo_comuna2_idx` (`destino` ASC),
            CONSTRAINT `espacio_e_fk`
              FOREIGN KEY (`espacio`)
              REFERENCES `cc500213_db`.`espacio_encargo` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `kilos_e_fk`
              FOREIGN KEY (`kilos`)
              REFERENCES `cc500213_db`.`kilos_encargo` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `fk_encargo_comuna1`
              FOREIGN KEY (`origen`)
              REFERENCES `cc500213_db`.`comuna` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `fk_encargo_comuna2`
              FOREIGN KEY (`destino`)
              REFERENCES `cc500213_db`.`comuna` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION)
            ENGINE = InnoDB;;";
    $db->query($sql);
}
?>
