# Eloquent ORM (Object Relational Mapping)

## Eloquent
Model::all()
Model::select('nCol1', 'nCol2')->get()
Model::find($id)
Model::find($id, $id3)
----
## QB     
table('nTable')
table('nTable')->select('nCol1', 'nCol2')
table('nTable')->where('colPK', $id)->first()
table('nTable')->where('colPK', $id)
->orWhere('colPK', $id2)->get()
table('nTable')->whereIn('colPK', [$id, $id2])->get()
table()->insert()
table()->update()
table()->delete()
----
## Raw SQL
select('SELECT * FROM nTable')
select('SELECT nCol1, nCol2 FROM nTable')
select('SELECT * FROM nTable WHERE colPK = :id')
insert()
update()
delete()
----
## PDO