package com.Practica.TecnicaW2M;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.builder.SpringApplicationBuilder;
import org.springframework.boot.web.servlet.support.SpringBootServletInitializer;
import org.springframework.cache.annotation.EnableCaching;
import org.springframework.context.annotation.ComponentScan;

@SpringBootApplication
@ComponentScan(basePackages = "com.Practica.TecnicaW2M")
@EnableCaching
public class TecnicaW2MApplication extends SpringBootServletInitializer{

	@Override
	protected SpringApplicationBuilder configure(SpringApplicationBuilder application) {
		return application.sources(TecnicaW2MApplication.class);
	}
	
	public static void main(String[] args) {
		SpringApplication.run(TecnicaW2MApplication.class, args);
	}

}
