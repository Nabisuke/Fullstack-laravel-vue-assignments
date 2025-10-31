const item = document.getElementById("item");
const addItemButton = document.getElementById("addItem");
const features = document.getElementById("features");
const modal = document.getElementById("todoModal");
const modalText = document.getElementById("modalTodoText");
const modalStatus = document.getElementById("modalTodoStatus");
const closeModal = document.querySelector(".close");

closeModal.addEventListener("click", function() {
    modal.style.display = "none";
});


window.addEventListener("click", function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

addItemButton.addEventListener("click", function() {
    addItem();
});

item.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        addItem();
    }
});

function addItem() {
    const itemValue = item.value.trim();
    if (itemValue !== "") {
        const li = document.createElement("li");
        
        const todoText = document.createElement("span");
        todoText.textContent = itemValue;
        todoText.className = "todo-text";
        
        todoText.addEventListener("click", function() {
            viewTodo(li, itemValue);
        });
        
        li.appendChild(todoText);
        
        const actionsDiv = document.createElement("div");
        actionsDiv.className = "todo-actions";
        

        actionsDiv.appendChild(createCompleteButton());
        actionsDiv.appendChild(createViewButton());
        actionsDiv.appendChild(createEditButton());
        actionsDiv.appendChild(createDeleteButton());
        
        li.appendChild(actionsDiv);
        features.appendChild(li);
        item.value = "";
    } else {
        alert("Please enter a valid item.");
        return;
    }
}

function createCompleteButton() {
    const completeButton = document.createElement("button");
    completeButton.textContent = "Done";
    completeButton.className = "complete-btn";
    completeButton.title = "Mark as completed";
    completeButton.addEventListener("click", function() {
        const listItem = this.parentElement.parentElement;
        listItem.classList.toggle("completed");
        
        if (listItem.classList.contains("completed")) {
            this.textContent = "Undone";
            this.title = "Mark as incomplete";
        } else {
            this.textContent = "Done";
            this.title = "Mark as completed";
        }
    });
    return completeButton;
}

function createViewButton() {
    const viewButton = document.createElement("button");
    viewButton.textContent = "View";
    viewButton.className = "view-btn";
    viewButton.addEventListener("click", function() {
        const listItem = this.parentElement.parentElement;
        const todoText = listItem.querySelector(".todo-text").textContent;
        viewTodo(listItem, todoText);
    });
    return viewButton;
}

function createEditButton() {
    const editButton = document.createElement("button");
    editButton.textContent = "Edit";
    editButton.className = "edit-btn";
    editButton.addEventListener("click", function() {
        const listItem = this.parentElement.parentElement;
        const todoText = listItem.querySelector(".todo-text");
        const currentText = todoText.textContent;
        
        const editInput = document.createElement("input");
        editInput.type = "text";
        editInput.value = currentText;
        editInput.className = "edit-input";
        editInput.style.flex = "1";
        editInput.style.marginRight = "10px";
        
        listItem.replaceChild(editInput, todoText);
        editInput.focus();
        editInput.select();
        
        let isSaving = false;
        
        editInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                saveEdit();
            }
        });
        
        editInput.addEventListener("blur", function() {
            saveEdit();
        });
        
        function saveEdit() {
            if (isSaving) return;
            isSaving = true;
            
            const newText = editInput.value.trim();
            if (newText !== "") {
                todoText.textContent = newText;
                try {
                    if (editInput.parentElement === listItem) {
                        listItem.replaceChild(todoText, editInput);
                    }
                } catch (e) {
                }
            } else {
                alert("Todo cannot be empty!");
                editInput.focus();
                isSaving = false;
            }
        }
    });
    return editButton;
}

function createDeleteButton() {
    const deleteButton = document.createElement("button");
    deleteButton.textContent = "Delete";
    deleteButton.className = "delete-btn";
    deleteButton.addEventListener("click", function() {
        const listItem = this.parentElement.parentElement;
        if (confirm("Are you sure you want to delete this todo?")) {
            features.removeChild(listItem);
        }
    });
    return deleteButton;
}

function viewTodo(listItem, todoText) {
    const isCompleted = listItem.classList.contains("completed");
    modalText.textContent = todoText;
    modalStatus.textContent = isCompleted ? "Status: Completed!" : "Status: Pending...";
    modalStatus.style.color = isCompleted ? "#4CAF50" : "#ff9800";
    modal.style.display = "block";
}