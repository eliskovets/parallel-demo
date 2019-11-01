#!/usr/bin/env bash

docker-compose -f docker/docker-compose.yaml pull && \
	docker-compose -f docker/docker-compose.yaml up --build --remove-orphans $@
