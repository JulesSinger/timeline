<template>
  <div id="todolist-page" v-if="todolist">
    <div id="header" class="mt-1" @click="closeCreateForm()">
      <router-link :to="{name: 'Todolists'}" class="router">
        <img src="/images/left_direction.svg"  alt="back" class="icon"/>
      </router-link>
      <h2 class="text-center">{{ todolist.name }}</h2>
      <p class="hidden">s</p>
    </div>
    <div id="todos-container">
      <div v-for="todo in todolist.todos" :key="todo.id" >
        <div v-if="!todo.done" class="todo">

          <div class="flex">
            <input type="radio" @click="callSwitchTodo(todo.id)" :checked="todo.done" class="checkbox" >
  
            <div class="todo-title">
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

      <div id="add-task-button" @click="displayCreateForm()">
        <img src="/images/plus.svg" alt=" + " class="icon">
        <button>Tâche</button>
      </div>
      <div class="todos-done">
        <h3>Tâches terminées</h3>
        <div v-for="todo in todolist.todos" :key="todo.id" >
          <div v-if="todo.done" class="todo done">
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
  </div>
</template>

<script setup>
import { reactive } from 'vue';
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
const { todolist, getTodolist, postTodo, switchTodo } = useTodolist(todolist_id)

const displayCreateForm = () => {
  const todo_create = document.getElementById('create-todo')
  todo_create.classList.remove('hidden')
  if (direction == 'vertical') {
    const page = document.getElementById('todolist-page')
    page.classList.add('black-filter')
    page.classList.add('create-mode')
  }
}

const closeCreateForm = () => {
  const todo_create = document.getElementById('create-todo')
  todo_create.classList.add('hidden')
  if (direction == 'vertical') {
    const page = document.getElementById('todolist-page')
    page.classList.remove('black-filter')
    page.classList.remove('create-mode')
  }
}

const callPostTodo = () => {
  postTodo(insert_form)
  closeCreateForm()
}

const callSwitchTodo = (id) => {
  switchTodo(id)
}


getTodolist()

</script>