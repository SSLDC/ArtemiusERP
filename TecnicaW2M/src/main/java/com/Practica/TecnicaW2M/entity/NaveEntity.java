package com.Practica.TecnicaW2M.entity;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table(name = "nave")
public class NaveEntity {
	
	@Id
	private Integer id;
	private String nombre;
	
	public NaveEntity() {
		
	}
	
	public NaveEntity(int id, String nom) {
		this.id=id;
		this.nombre=nom;
	}
	
	public Integer getId() {
		return id;
	}
	public void setId(Integer id) {
		this.id = id;
	}
	public String getNombre() {
		return nombre;
	}
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}
	
	@Override
	public String toString() {
		return "NaveEntity [id=" + id + ", nombre=" + nombre + "]";
	}

}
