
-- create database
DROP SCHEMA IF EXISTS Roadio_DB;
CREATE DATABASE Roadio_DB;
USE Roadio_DB;

-- create circular road segments
CREATE TABLE road_segments (
  road_segment_id INTEGER PRIMARY KEY AUTO_INCREMENT,
  road_segment_circle GEOMETRY,
  segment_surface_quality INTEGER
);
 
-- road datapoints that make up a segment
CREATE TABLE road_datapoints(
  road_datapoint_id INTEGER PRIMARY KEY AUTO_INCREMENT,
  road_datapoint GEOMETRY,
  surface_quality INTEGER,
  road_segment_id INTEGER,
  time_recorded TIMESTAMP,
  FOREIGN KEY (road_segment_id) REFERENCES road_segments(road_segment_id)
);

-- NOT USED AT THE MOMENT
-- phone accelerometer and GPS data
CREATE TABLE phone_accelerometer_data (
  data_id PRIMARY KEY AUTO_INCREMENT,
  acceleration_zmean FLOAT,
  acceleration_zstd FLOAT,
  acceleration_zvariance FLOAT,
  acceleration_zpeak FLOAT,
  acceleration_zlow FLOAT,
  latitude FLOAT,
  longitude FLOAT,
  time_recorded TIMESTAMP
);