package com.Practica.TecnicaW2M.repository;

import java.awt.print.Pageable;
import java.util.List;
import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.Practica.TecnicaW2M.entity.NaveEntity;

@Repository
public interface RepositoryNave extends JpaRepository<NaveEntity, Integer> {
	
	Optional<NaveEntity> findById(Integer id);
	
	NaveEntity save(NaveEntity nave);
	
	List<NaveEntity> findByNombreContaining(String nombre);
	
	void deleteById(Integer id);
}
