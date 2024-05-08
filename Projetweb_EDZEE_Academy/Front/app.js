const johnSelectorBtn = document.querySelector('#john-selector')
const janeSelectorBtn = document.querySelector('#jane-selector')
const chatHeader = document.querySelector('.chat-header')
const chatMessages = document.querySelector('.chat-messages')
const chatInputForm = document.querySelector('.chat-input-form')
const chatInput = document.querySelector('.chat-input')
const clearChatBtn = document.querySelector('.clear-chat-button')

const messages = JSON.parse(localStorage.getItem('messages')) || []

const createChatMessageElement = (message) => `
  <div class="message ${message.sender === 'John' ? 'blue-bg' : 'gray-bg'}">
    <div class="message-sender">${message.sender}</div>
    <div class="message-text">${message.text}</div>
    <div class="message-timestamp">${message.timestamp}</div>
  </div>
`

window.onload = () => {
  messages.forEach((message) => {
    chatMessages.innerHTML += createChatMessageElement(message)
  })
}

let messageSender = 'John'

const updateMessageSender = (name) => {
  messageSender = name
  chatHeader.innerText = `${messageSender} chatting...`
  chatInput.placeholder = `Type here, ${messageSender}...`

  if (name === 'John') {
    johnSelectorBtn.classList.add('active-person')
    janeSelectorBtn.classList.remove('active-person')
  }
  if (name === 'Jane') {
    janeSelectorBtn.classList.add('active-person')
    johnSelectorBtn.classList.remove('active-person')
  }

  /* auto-focus the input field */
  chatInput.focus()
}

johnSelectorBtn.onclick = () => updateMessageSender('John')
janeSelectorBtn.onclick = () => updateMessageSender('Jane')

const sendMessage = (e) => {
  e.preventDefault()

  const timestamp = new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
  const message = {
    sender: messageSender,
    text: chatInput.value,
    timestamp,
  }

  let response = ''; // Initialize the response variable

  // Analyze the message text and generate a response accordingly
  if (message.text.toLowerCase().includes("formations")) {
    response = "Notre site contient des formations en JavaScript, HTML, C/C++, Python et Java.";
  } else if (message.text.toLowerCase().includes("heure")) {
    // Generate a random start time for each formation
    const formations = ["JavaScript", "HTML", "C/C++", "Python", "Java"];
    const randomFormation = formations[Math.floor(Math.random() * formations.length)];
    const randomHour = Math.floor(Math.random() * 24); // Random hour
    const randomMinute = Math.floor(Math.random() * 60); // Random minute
    response = `La formation en ${randomFormation} commence à ${randomHour}:${randomMinute < 10 ? '0' : ''}${randomMinute}.`;
  } else if (message.text.toLowerCase().includes("emploi")) {
    // Respond with the schedule of formations
    response = "Voici les emplois du temps des formations : \n" +
      "JavaScript : Lundi et Mercredi à 10:00\n" +
      "HTML : Mardi et Jeudi à 14:00\n" +
      "C/C++ : Lundi et Vendredi à 13:00\n" +
      "Python : Mercredi et Vendredi à 11:00\n" +
      "Java : Mardi et Jeudi à 12:00";
  }

  /* Save message to local storage */
  messages.push(message)
  localStorage.setItem('messages', JSON.stringify(messages))

  /* Add message to DOM */
  chatMessages.innerHTML += createChatMessageElement(message)

  // If there's a response, add it to the chat as well
  if (response !== '') {
    const responseMessage = {
      sender: 'Bot',
      text: response,
      timestamp: new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
    };
    chatMessages.innerHTML += createChatMessageElement(responseMessage);
  }

  /* Clear input field */
  chatInputForm.reset()

  /*  Scroll to bottom of chat messages */
  chatMessages.scrollTop = chatMessages.scrollHeight
}

chatInputForm.addEventListener('submit', sendMessage)

clearChatBtn.addEventListener('click', () => {
  localStorage.clear()
  chatMessages.innerHTML = ''
})
