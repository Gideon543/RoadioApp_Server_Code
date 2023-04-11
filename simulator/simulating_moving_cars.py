import requests

# define the API endpoint
url = 'http://localhost:5000/api/data'

# define the data to be sent
data = {
    'name': 'John Doe',
    'age': 30,
    'email': 'johndoe@example.com'
}

# send a POST request with the data
response = requests.post(url, json=data)

# check the response status code
if response.status_code == 200:
    print response.message
else:
    print('Error posting data to the API.')