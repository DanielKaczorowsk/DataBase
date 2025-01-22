# Search Database
     $this->base = new Model\MyBasePDO;
     $this->base->Connect();
    ->Select(['1','2'])
    ->From('Your From') -> null = From role
    ->Where(['Role=Admin','Uprawnienia=Adder']) -> implode AND
    ->OrWhere(['Role=Admin','Uprawnienia=Adder']) ->implode OR, if Where is not null can use WHERE then OrWhere
    ->ON(['']) ->implode AND
    ->INNERJOIN(['innerjoin'],'['on']') -> ->INNERJOIN(['permission a','role b'],['a.id=b.id_permission']);
# Add Database
     $this->base = new Model\MyBasePDO;
     $this->base->Connect();
     $this->base->add('from',['names'],['values']);
# Update Database
     $this->base = new Model\MyBasePDO;
     $this->base->Connect();
     $this->base->update('from',['names'],['values']);
