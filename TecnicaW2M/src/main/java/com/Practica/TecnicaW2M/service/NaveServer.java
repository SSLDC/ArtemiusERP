package com.Practica.TecnicaW2M.service;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.Practica.TecnicaW2M.entity.NaveEntity;
import com.Practica.TecnicaW2M.repository.RepositoryNave;

import org.springframework.cache.annotation.CacheEvict;
import org.springframework.cache.annotation.Cacheable;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.stereotype.Service;

@Service
public class NaveServer implements Inave{

	@Autowired RepositoryNave repositoryNave;
	@Override
	public String GetNombre(String nom) {
		// TODO Auto-generated method stub
		return "Nave: "+nom;
	}
	
	public Page<NaveEntity> GetAllNaves(Pageable pageable){
		return repositoryNave.findAll(pageable);
	}
	
	 @Cacheable(value = "naves", key = "#id")
	public Optional<NaveEntity> GetNaveById(Integer id){
		return repositoryNave.findById(id);
	}
	
	 @Cacheable(value = "naves", key = "#id")
    public List<NaveEntity> FindNombre(String nom) {
        return repositoryNave.findByNombreContaining(nom);
    }
	
	public NaveEntity save(NaveEntity nave) {
		return repositoryNave.save(nave);
	}
	
	// @CacheEvict(value = "naves", key = "#id")
	public NaveEntity Update(NaveEntity nave){
		
		if(nave.getId() != null && repositoryNave.existsById(nave.getId())) {
			return repositoryNave.save(nave);
		}
		
		return null;
	}
	
	 @CacheEvict(value = "naves", key = "#id")
	public void delete(Integer id){
		repositoryNave.deleteById(id);
	}
}
