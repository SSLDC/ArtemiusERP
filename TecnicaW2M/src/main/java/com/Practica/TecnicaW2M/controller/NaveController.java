package com.Practica.TecnicaW2M.controller;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import java.util.LinkedList;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.Practica.TecnicaW2M.entity.NaveEntity;
import com.Practica.TecnicaW2M.service.Inave;
import com.Practica.TecnicaW2M.service.NaveServer;

import jakarta.ws.rs.Produces;

@Produces({"application/json"})
@RestController
@RequestMapping("/NavesPeliculas")
public class NaveController {

	@Autowired private NaveServer naveServer;
	
	/*
	@GetMapping("/ObtenerNave/{nombre}")
	public String ObtenerNave(@PathVariable("nombre") String nom) {
		String respuesta=null;
		
		try {
			respuesta=nave.GetNombre(nom);
		}catch (Exception e) {
			System.out.println("error");
		}
		
		return respuesta;
	}
	*/
	
	@GetMapping("/getAll")
	public Page<NaveEntity> GetAll(Pageable pageable){
		return naveServer.GetAllNaves(pageable);
	}
	
	@GetMapping("/GetNaveById")
	public Optional<NaveEntity> getNaveById(@RequestParam Integer id){
		
		return naveServer.GetNaveById(id);
	}
	
	@GetMapping("/FilterName/{nombre}")
    public List<NaveEntity> FilterName(@PathVariable String nombre) {
        LinkedList<NaveEntity> AllShips = new LinkedList<>();
        for (NaveEntity c : naveServer.FindNombre(nombre)) {
            if (c.getNombre().contains(nombre)) {
                AllShips.add(c);
            }
        }
        return AllShips;
    }
	
	@PostMapping("/save")
	public NaveEntity save(@RequestBody NaveEntity nave) {
		return naveServer.save(nave);
	}
	
	@PutMapping("/update")
	public NaveEntity updateNave(@RequestBody NaveEntity nave) {
		return naveServer.Update(nave);
	}
	
	@DeleteMapping("/delete/{id}")
	public void delete(@PathVariable Integer id){
		naveServer.delete(id);
	}
	
} 