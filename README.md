# RoadioApp_Server_Code

Roadio is a transportation system that monitors road conditions in real-time to identify areas that require
maintenance or repairs. By collecting data from multiple drivers' mobile devices that are fixed in their vehicles and use the 
accelerometer to record data related to the roughness of the road. The collected data will be used to generate a roughness 
index for specific segments of roads mapped by the GPS location (latitude and longitude) at the point of recording.

Roadio system includes a mobile application that drivers can download and install on their mobile devices. The application 
would run in the background while the driver is driving and periodically record accelerometer data at fixed intervals, such 
as every second or every 10 seconds. The data collected would include the `acceleration_zmean` value, `timestamp`, and the 
GPS location of the driver's vehicle at the time of recording.

The collected data would be sent to a central database hosted on the department's server, where the data would be stored 
in the tables created  SQL code.

The accelerometer data would be stored in the `phone_accelerometer_data` table, which would be linked to the `drivers_phones` 
table to identify the specific driver and phone used to collect the data. The GPS location would be stored in the 
`road_condition_data` table, which would also include the `surface_quality_index` value, `timestamp`, and the roughness index 
value calculated based on the collected data.

Roadio could be used to identify areas that require maintenance or repairs. For example, the department could set a threshold 
value for the roughness index, and any road segment with a roughness index value above the threshold would be flagged for 
maintenance or repairs. The department could also use the data to track changes in the roughness of the road over time and 
identify trends or patterns that could help improve road maintenance and repairs.

The purpose of Roadio's database system is for managing and analyzing the crowdsourced data collected from drivers' mobile 
devices. With this system, Roadio can collect and analyze data in real-time, improving the efficiency and effectiveness of 
road maintenance and repairs in Ghana.

Once the first functional prototype is ready, testing should begin in Berekuso to ensure continuous testing and feedback to 
inform constant improvements and iterations to the system.
