import './App.css';

import Todotable from './components/TodoTable';
import NewtodoComponent from './components/NewTodoComponent';
import React, {useState} from 'react';



// const todos=[
//   {rownNumber:1, rowDescription: 'feed puppies'},{rownNumber:2, rowDescription: 'feed cat'},{rownNumber:3, rowDescription: 'feed dogs'}
// ]


function App() {

  const [showAddTodoFOrm, setShowAddTodoForm] = useState(false);

  const addtodo = () =>{
    console.log("button clicked")
    if(todos.length > 0){
      const newtodo={rownNumber:todos.length+1, rowDescription: 'feed new puppies'}
      settodos(todos => [...todos,newtodo])
    }
      //todos.push(newtodo);


    }


  const addtodo_data = (description) =>{
    let rownNumber =0;
    console.log("button clicked")
    if(todos.length > 0){
      rownNumber = todos[todos.length-1].rownNumber+1;
    }
    else{
      rownNumber = 1;
    }
      const newtodo={rownNumber:rownNumber, rowDescription: description}
      settodos(todos => [...todos,newtodo])
    
      //todos.push(newtodo);


    }
  
    const deleteTodo = (deleteTodoRowNumber) => {
      let filtered = todos.filter(function(value){
        return value.rownNumber !== deleteTodoRowNumber;
      })
      settodos(filtered);
    }

  const [todos,settodos] = useState([
    {rownNumber:1, rowDescription: 'feed puppies'},
    {rownNumber:2, rowDescription: 'feed cat'},
    {rownNumber:3, rowDescription: 'feed dogs'}
  ]);

  return (
    <div className="App" className='mt-5 container'>
<div className="card">
        <div className = "card-header">Your Todo's</div>
        <div className="card-body">
          
      <Todotable todos={todos} deleteTodo ={deleteTodo}></Todotable>
      <button className="btn btn-primary btn-hover" onClick={addtodo}>Add New Todo</button><br></br><br></br>
      <button className="btn btn-primary btn-hover" onClick={() => setShowAddTodoForm(!showAddTodoFOrm)}>{showAddTodoFOrm ? 'Close new todo' : 'new todo'}</button>
      {showAddTodoFOrm && <NewtodoComponent addtodo_data={addtodo_data}></NewtodoComponent>}
      {/* <NewtodoComponent addtodo_data={addtodo_data}></NewtodoComponent> */}

        </div>
        
      </div>

    </div>
  );
}

export default App;
