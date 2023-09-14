
with open('test.txt','r') as file:
	for i in file:
		x = i.replace("'",'"')
		with open('newtest.txt','w') as wr:
			wr.write(x)
	


	

			
