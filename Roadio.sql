--How to connect spatial extension to mysql 
CREATE DATABASE roadio_db;
USE roadio_db;


--Verifying Connection to spatial Extension
SHOW VARIABLES LIKE 'have_%';

-- Drivers Phones Table
CREATE TABLE drivers_phones (
  phone_id SERIAL PRIMARY KEY,
  model_name VARCHAR(55) UNIQUE,
  operating_system TEXT
);

-- Phone Accelerometer Data Table
CREATE TABLE phone_accelerometer_data (
  id SERIAL PRIMARY KEY,
  phone_id INTEGER REFERENCES drivers_phones(phone_id),
  acceleration_zmean FLOAT,
  acceleration_zstd FLOAT,
  acceleration_zvariance FLOAT,
  acceleration_zpeak FLOAT,
  acceleration_zlow FLOAT,
  latitude FLOAT,
  longitude FLOAT,
  time_recorded TIMESTAMP
);

-- Road Condition Data Table
CREATE TABLE road_condition_data (
  id SERIAL PRIMARY KEY,
  road_segment_id INTEGER REFERENCES road_segments(id),
  accelerometer_id INTEGER REFERENCES accelerometers(id),
  quality_index INTEGER CHECK (quality_index >= 0 AND quality_index <= 100),
  time_recorded TIMESTAMP NOT NULL
);

ALTER TABLE road_condition_data ADD CHECK (quality_index >= 0 AND quality_index <= 2);

-- Segment Roughness Index Table
CREATE TABLE segment_roughness_index(
  id SERIAL PRIMARY KEY,
  time_recorded TIMESTAMP, --pick only the time the index was generated 
  latitude FLOAT, --(GPS)
  longitude FLOAT,
  overall_segment_roughness_index FLOAT,
  classification_0 int, --to extend the margin for  different classifiers to be used and get count of specific prediction about a road segment 
  classification_1 int,
  classification_2 int,
  classification_3 int,
  classification_4 int,
  classification_5 int,
);



-- Roads Table
CREATE TABLE roads (
  id SERIAL PRIMARY KEY,
  name TEXT,
  latitude FLOAT,
  longitude FLOAT,
  segment_segment_roughness_index FLOAT
);

-- Create Road Segments Table
CREATE TABLE road_segments (
  id SERIAL PRIMARY KEY,
  segment_segment_roughness_index FOREIGN KEY,
 /* start_latitude FLOAT,
  start_longitude FLOAT,
  end_latitude FLOAT,
  end_longitude FLOAT,*/
  point POINT, (Radial segmentation (Circles))
  road_id INTEGER REFERENCES roads(id),
  timestamp TIMESTAMP
);

-- Insert data into drivers_phones table
INSERT INTO drivers_phones (model_name, operating_system)
VALUES
('Samsung Galaxy S20', 'Android'),
('iPhone 12 Pro', 'iOS'),
('OnePlus 9 Pro', 'Android');

-- Insert data into phone_accelerometer_data table
INSERT INTO phone_accelerometer_data (phone_id, acceleration_zmean, timestamp)
VALUES
(1, 1.5, '2022-01-01 09:00:00'),
(2, 1.8, '2022-01-01 09:05:00'),
(3, 2.0, '2022-01-01 09:10:00');

-- Insert data into road_condition_data table
INSERT INTO road_condition_data (accelerometer_id, quality_index, point, timestamp)
VALUES
(1, 0.6, ST_GeomFromText('POINT(37.1234 -122.4321)', 4326), '2022-01-01 09:00:00'),
(2, 0.7, ST_GeomFromText('POINT(37.1235 -122.4322)', 4326), '2022-01-01 09:05:00'),
(3, 0.8, ST_GeomFromText('POINT(37.1236 -122.4323)', 4326), '2022-01-01 09:10:00');

-- Insert data into segment_roughness_index table
INSERT INTO segment_segment_roughness_index (start_timestamp, end_timestamp, gps, segment_roughness_index)
VALUES
('2022-01-01 09:00:00', '2022-01-01 09:30:00', ST_GeomFromText('POINT(37.1234 -122.4321)', 4326), 0.7),
('2022-01-01 09:30:00', '2022-01-01 10:00:00', ST_GeomFromText('POINT(37.1235 -122.4322)', 4326), 0.8),
('2022-01-01 10:00:00', '2022-01-01 10:30:00', ST_GeomFromText('POINT(37.1236 -122.4323)', 4326), 0.9);

-- Insert data into roads table
INSERT INTO roads (name, gps, segment_roughness_index)
VALUES
('Kwabenya', ST_GeomFromText('POINT(37.1234 -122.4321)', 4326), 0.7),
('Berekuso', ST_GeomFromText('POINT(37.1235 -122.4322)', 4326), 0.8),
('Pokuase', ST_GeomFromText('POINT(37.1236 -122.4323)', 4326), 0.9);



-----------------------------------------------------------------------------------

-- Add Check Constraint to Road Condition Data Table
ALTER TABLE road_condition_data
ADD CONSTRAINT quality_index_range CHECK (quality_index BETWEEN 0 AND 2);

--Get the roughness index for a specific road segment:
SELECT segment_roughness_index FROM road_segments 
WHERE start_latitude = [start_latitude] AND start_longitude = [start_longitude] 
AND end_latitude = [end_latitude] AND end_longitude = [end_longitude]

--Get the road condition data for a specific location:
SELECT quality_index FROM road_condition_data 
WHERE latitude = [latitude] AND longitude = [longitude]


/*--Get the roughness index for a specific road:
SELECT segment_roughness_index FROM roads 
WHERE name = [road_name]
---------------------------------------------------------------------------------------
*/

/*

-- Averaging Aggregate Query: For calculating the Average Roughness Index for Road Segments
SELECT AVG(segment_roughness_index) FROM road_segments;

--  Join Query: Phone Model Name with Accelerometer Data
SELECT drivers_phones.model_name, phone_accelerometer_data.acceleration_zmean, phone_accelerometer_data.timestamp
FROM phone_accelerometer_data
INNER JOIN drivers_phones ON phone_accelerometer_data.phone_id = drivers_phones.phone_id;

--Get the average acceleration_zmean for each phone:
SELECT model_name, AVG(acceleration_zmean) as avg_zmean 
FROM phone_accelerometer_data 
JOIN drivers_phones ON phone_accelerometer_data.phone_id = drivers_phones.phone_id 
GROUP BY model_name


-- Average Roughness Index for Road Segments using latitude and longitude points over a certain time period 
SELECT id, start_latitude, start_longitude, end_latitude, end_longitude, segment_roughness_index, timestamp, AVG(segment_roughness_index) OVER (ORDER BY timestamp ROWS BETWEEN 4 PRECEDING AND CURRENT ROW) AS running_avg_segment_roughness_index
FROM road_segments;

-- Query to get road roughness indexes along with their coordinates
SELECT latitude, longitude, segment_roughness_index FROM segment_roughness_index;




--Get the roughness index and road name for each road segment:
SELECT roads.name, road_segments.segment_roughness_index 
FROM roads 
JOIN road_segments ON roads.latitude = road_segments.start_latitude 
AND roads.longitude = road_segments.start_longitude 
AND roads.latitude = road_segments.end_latitude 
AND roads.longitude = road_segments.end_longitude


--  Join Query: Road Name with Roughness Index
SELECT roads.name, segment_roughness_index.segment_roughness_index, segment_roughness_index.start_timestamp
FROM segment_roughness_index
INNER JOIN roads ON ST_DWithin(roads.longitude || ' ' || roads.latitude::text, segment_roughness_index.longitude || ' ' || segment_roughness_index.latitude::text, 0.01);
*/