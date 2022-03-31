let play_board = ["","","","","","","","",""];
let winner_box = [];
let empty_box = 0;
let has_won = false;
let points = 0;
let xhr = new XMLHttpRequest();
const board_container = document.querySelector(".game");

let board_full = false;
const winner = document.getElementById("winner");
const score = document.getElementById("score");
const player = "O";
const computer = "X";

const render_board = () => {
  board_container.innerHTML = "";
  play_board.forEach((e, i) => {
    board_container.innerHTML += `<div id="block_${i}" class="block" onclick="addPlayerMove(${i})">${play_board[i]}</div>`;
    if (e == player || e == computer){
      document.querySelector(`#block_${i}`).classList.add("occupied");
    }
  });
};

const addPlayerMove = e => {
  if(play_board[e] == "") {
    play_board[e] = player;
    game_loop();
    if(has_won == false && empty_box == 0){
      addComputerMove();
    }

  }
};

const addComputerMove = () => {
  do{
    selected = Math.floor(Math.random() * 9);
  } while (play_board[selected] != "");
  play_board[selected] = computer;
  game_loop();
};

const check_board_complete = () => {
  let count = 0;
  play_board.forEach(element => {
    if(element != player && element != computer){
      count += 1;
    }
  });
  if(count == 0){
    board_full = true;
  } else if (count == 1){
    empty_box = 1;
  }
};

const check_line = (a,b,c) => {
  return (
    play_board[a] == play_board[b] && play_board[b] == play_board[c] && (play_board[a] == player || play_board[a] == computer)
  );
};

const check_match = () => {
  for(i = 0; i < 9; i += 3){
    if (check_line(i,i+1,i+2)) {
      winner_box = [i,i+1,i+2];
      return play_board[i];
    }
  }
  for(i = 0; i < 3; i++){
    if(check_line(i,i+3,i+6)){
      winner_box = [i,i+3,i+6];
      return play_board[i];
    }
  }
  if(check_line(0, 4, 8)){
    winner_box = [0, 4, 8];
    return play_board[0];
  }
  if (check_line(2,4,6)) {
    winner_box = [2,4,6];
    return play_board[2];
  }
  return "";
}

const game_stop = () =>{
  for(i=0;i<9;i++){
    document.querySelector(`#block_${i}`).style.pointerEvents = "none";
  }
};

const set_winner = (p) => {
  if(p == player){
    winner_box.forEach(e => {
      document.querySelector(`#block_${e}`).classList.add("Won");
    });
  } else if (p == computer) {
    winner_box.forEach(e => {
      document.querySelector(`#block_${e}`).classList.add("Lost");
    });
  }
};

const update_score = (e) => {
  points = points + e;
  score.innerText = points;

  //UpdateScore in DB
  if(e == 1){
    xhr.open("GET","updateScore.php");
    xhr.send(null);
  }

};

const check_winner = () => {
  let result = check_match();
  if(result == player){
    winner.innerText = "You Win!";
    winner.classList.add("playerWin");
    board_full = true;
    has_won = true;
    update_score(1);
    set_winner(player);
    game_stop();

  } else if(result == computer){
    winner.innerText = "You Lose!";
    winner.classList.add("computerWin");
    set_winner(computer);
    board_full = true;
    game_stop();
  } else if (board_full){
    winner.innerText = "It's a Draw!";
    winner.classList.add("draw");
    game_stop();
  }
};

const game_loop = () => {
  check_board_complete();
  render_board();
  check_winner();
};

const new_game = () => {
  play_board = ["","","","","","","","",""];
  board_full = false;
  has_won = false;
  empty_box = 0;
  winner.classList.remove("playerWin");
  winner.classList.remove("computerWin");
  winner.classList.remove("draw");
  winner.innerText = "";
  render_board();
};

update_score(0);
render_board();
