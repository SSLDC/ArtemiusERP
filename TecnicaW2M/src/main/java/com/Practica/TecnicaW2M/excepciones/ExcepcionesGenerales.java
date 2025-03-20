package com.Practica.TecnicaW2M.excepciones;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.ControllerAdvice;
import org.springframework.web.bind.annotation.ExceptionHandler;

@ControllerAdvice
public class ExcepcionesGenerales {

	@ExceptionHandler(Exception.class)
	public ResponseEntity<String> handleGeneralException(Exception ex){
		return new ResponseEntity<>("Ha ocurrido un error", HttpStatus.INTERNAL_SERVER_ERROR);
	}
}
