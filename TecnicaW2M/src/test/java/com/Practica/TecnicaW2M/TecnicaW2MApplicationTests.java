package com.Practica.TecnicaW2M;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertNotNull;
import static org.junit.jupiter.api.Assertions.assertNull;
import static org.junit.jupiter.api.Assertions.assertTrue;

import java.util.LinkedList;
import java.util.Optional;

import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;

import com.Practica.TecnicaW2M.controller.NaveController;
import com.Practica.TecnicaW2M.entity.NaveEntity;
import com.Practica.TecnicaW2M.service.NaveServer;

@SpringBootTest
class TecnicaW2MApplicationTests {

	@Autowired NaveServer naveServer;
	
	@Test
	void GuardarNave() {
		NaveEntity n= new NaveEntity(1, "Enterprise");
		
		NaveEntity n2= naveServer.save(n);
		
		assertNotNull(n2, "No debe estar vacio");
	}
	
	@Test
	void ObtenerNaveTest() {
		
		Optional<NaveEntity> nave = naveServer.GetNaveById(1);
		
		assertTrue(nave.isPresent());
		assertEquals(1, nave.get().getId(), "hay una nave");
	}
	@Test
	void ObtenerNaves() {
		
		Pageable pageable = PageRequest.of(0, 10);
		
		Page<NaveEntity> naves = naveServer.GetAllNaves(pageable);
		
		assertTrue(naves.hasContent(), "No debe estar vacía");
		
		assertEquals(10, naves.getSize(), "tiene que ser 10");
	}
	
	@Test
	void ActualizarNave() {
		NaveEntity n= new NaveEntity(1, "Falcon");
		
		NaveEntity n2= naveServer.Update(n);
		
		assertEquals("Falcon", n2.getNombre());
	}
	
	@Test
	void EliminarNave() {
		naveServer.delete(1);
		
		Optional<NaveEntity> nave = naveServer.GetNaveById(1);
		
		assertTrue(nave.isEmpty(), "debe estar vacío");
	}

}
