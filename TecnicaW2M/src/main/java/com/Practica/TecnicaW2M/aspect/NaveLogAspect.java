package com.Practica.TecnicaW2M.aspect;

import org.aspectj.lang.annotation.Aspect;
import org.aspectj.lang.annotation.Before;
import org.slf4j.Logger;
import org.springframework.stereotype.Component;

@Aspect
@Component
public class NaveLogAspect {

	private static final Logger logger = org.slf4j.LoggerFactory.getLogger(NaveLogAspect.class);
	
    @Before("execution(* com.Practica.TecnicaW2M.service.NaveService.getNaveById(Long)) && args(id)")
    public void LogIfIdNegative(Long id) {
    	if(id<0) logger.warn("Se ha solicitado una nave con un ID negativo: {}", id);
    }
}
