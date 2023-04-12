<template>
  <div id="todolist-page" v-if="todolist">
    <div id="header" class="mt-1" @click="closeCreateForm() & closeUpdateForm()">
      <router-link :to="{name: 'Todolists'}" class="router">
        <img src="/images/left_direction.svg"  alt="back" class="icon"/>
      </router-link>
      <h2 class="text-center">{{ todolist.name }}</h2>
      <p class="hidden">s</p>
    </div>
    <div id="todos-container">
      <div v-for="todo in todolist.todos" :key="todo.id" >
        <div v-if="!todo.done" class="todo">
          <div class="flex fullpr">
            <input type="radio" @click="callSwitchTodo(todo.id)" :checked="todo.done" class="checkbox" >
            <div class="flex fullpr" @click="displayUpdateForm()">
    
              <div class="todo-title" >
                <h3>{{ todo.title }}</h3>
              </div>
              <div class="todo-description undisplayed">
                <p>{{ todo.description }}</p>
              </div>
            </div>
            <div class="todo-priority weak" id="weak" v-if="todo.priority == 0">
              <h3>!</h3>
            </div>
            <div class="todo-priority normal" v-else-if="todo.priority == 1">
              <h3>!!</h3>
            </div>
            <div class="todo-priority strong" v-else="todo.priority == 2">
              <h3>!!!</h3>
            </div>
          </div>

        </div>
      </div>

      <div id="add-task-button" @click="displayCreateForm()">
        <img src="/images/plus.svg" alt=" + " class="icon">
        <button>Tâche</button>
      </div>
      <div class="todos-done">
        <h3 class="p-05">Tâches terminées</h3>
        <div v-for="todo in todolist.todos" :key="todo.id" >
          <div v-if="todo.done" class="todo done">
            <div class="flex">
              <input type="radio" @click="callSwitchTodo(todo.id)" :checked="todo.done" class="checkbox" >
              <div class="todo-title">
                <h3>{{ todo.title }}</h3>
              </div>
              <div class="todo-content undisplayed">
                <p>{{ todo.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="create-todo" class="hidden">
      <div id="close">
        <div @click="closeCreateForm()">
          <img src="/images/close.png" alt="fermer" >
        </div>
      </div>
      <input type="text" v-model="insert_form.title" placeholder="Nom de la tâche*">
      <input type="text" v-model="insert_form.description" placeholder="Notes*">
      <div id="priority">
        <p>Priorité*</p>

        <div id="choices">
          <div class="choice">
            <label for="one">!</label>
            <input type="radio" id="one" value="1" v-model="insert_form.priority" />
          </div>
  
          <div class="choice">
            <label for="two">!!</label>
            <input type="radio" id="two" value="2" v-model="insert_form.priority" />
          </div>
  
          <div class="choice">
            <label for="two">!!!</label>
            <input type="radio" id="three" value="3" v-model="insert_form.priority" />
          </div>
        </div>
      </div>

      <div id="date">
        <p>Date</p>
        <input type="date" v-model="insert_form.deadline" placeholder="Date limite de la tâche">
      </div>
      <button class="btn btn-markup" @click="callPostTodo()">AJOUTER</button>
    </div>

    <div id="edit-todo" class="hidden">
      <div id="close">
        <div @click="closeUpdateForm()">
          <img src="/images/close.png" alt="fermer" >
        </div>
      </div>
      <input type="text" v-model="update_form.title" placeholder="Nom de la tâche*">
      <input type="text" v-model="update_form.description" placeholder="Notes*">
      <div id="priority">
        <p>Priorité*</p>

        <div id="choices">
          <div class="choice">
            <label for="one">!</label>
            <input type="radio" id="one" value="1" v-model="update_form.priority" />
          </div>
  
          <div class="choice">
            <label for="two">!!</label>
            <input type="radio" id="two" value="2" v-model="update_form.priority" />
          </div>
  
          <div class="choice">
            <label for="two">!!!</label>
            <input type="radio" id="three" value="3" v-model="update_form.priority" />
          </div>
        </div>
      </div>

      <div id="date">
        <p>Date</p>
        <input type="date" v-model="update_form.deadline" placeholder="Date limite de la tâche">
      </div>
      <button class="btn btn-markup" @click="callUpdateTodo()">Update</button>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useTodolist } from '../api/todolist.js'
import { useRoute } from 'vue-router';

const direction = screen.width < 500 ? 'vertical' : 'horizontal'

const route = useRoute()
const todolist_id = route.params.id
const insert_form = reactive({
  title: '',
  description: '',
  priority: 0,
  deadline: '',
})

const update_form = reactive({
  title: '',
  description: '',
  priority: 0,
  deadline: '',
})

const update_todo = ref(null)

const { todolist, getTodolist, postTodo, updateTodo, switchTodo } = useTodolist(todolist_id)

const displayCreateForm = () => {
  const todo_create = document.getElementById('create-todo')
  todo_create.classList.remove('hidden')
  if (direction == 'vertical') {
    const page = document.getElementById('todolist-page')
    page.classList.add('black-filter')
  }
}

const displayUpdateForm = (todo) => {
  console.log("update enter")
  update_todo.value = todo
  const todo_update = document.getElementById('edit-todo')
  todo_update.classList.remove('hidden')
  if (direction == 'vertical') {
    const page = document.getElementById('todolist-page')
    page.classList.add('black-filter')
  }
}

const closeCreateForm = () => {
  const todo_create = document.getElementById('create-todo')
  todo_create.classList.add('hidden')
  if (direction == 'vertical') {
    const page = document.getElementById('todolist-page')
    page.classList.remove('black-filter')
  }
}

const closeUpdateForm = () => {
  const todo_update = document.getElementById('edit-todo')
  todo_update.classList.add('hidden')
  if (direction == 'vertical') {
    const page = document.getElementById('todolist-page')
    page.classList.remove('black-filter')
  }
}

const callPostTodo = () => {
  postTodo(insert_form)
  closeCreateForm()
}

const callUpdateTodo = () => {
  updateTodo(update_form)
  closeUpdateForm()
}

const callSwitchTodo = (id) => {
  switchTodo(id)
}


getTodolist()

</script>