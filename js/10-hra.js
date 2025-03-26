
		// console.log(JSON.parse(localStorage.getItem('score')));

		// const score = {
		// 	user: 0,
		// 	comp: 0,
		// 	tie: 0
		// }

		console.log(localStorage.getItem('score'));

		const score = JSON.parse(localStorage.getItem('score')) || {
			user: 0,
			comp: 0,
			tie: 0,
			img_user: "",
			img_comp: ""
		};
		
		updateScoreElement();

		function pickComputerMove() {
			
			let computerMove = "";

			const randomNumber = Math.random();

			if(randomNumber >= 0 && randomNumber < 1/3) {
				computerMove = 'rock';
			}else
			if(randomNumber >= 1/3 && randomNumber < 2/3) {
				computerMove = 'paper';
			}else
			if(randomNumber >= 2/3 && randomNumber < 1) {
				computerMove = 'scissors';
			}else {
				computerMove = 'Computer si utrhl ruku';
			}

			return computerMove;
		}

		function playGame(userMove) {

			let result;
			const computerMove = pickComputerMove();

			if(computerMove === userMove) {
				result = 'Tie';
			}else
			if(computerMove === 'rock' && userMove === "paper") {
			result = 'You win';
			} else
			if(computerMove === 'scissors' && userMove === "paper") {
				result = 'You loose';
			} else
			if(computerMove === 'scissors' && userMove === "rock") {
				result = 'You win';
			} else
			if(computerMove === 'paper' && userMove === "rock") {
				result = 'You loose';
			} else
			if(computerMove === 'rock' && userMove === "scissors") {
				result = 'You loose';
			} else
			if(computerMove === 'paper' && userMove === "scissors") {
				result = 'You win';
			}

			if(result === "You win") {
				score.user++;
			}else
			if(result === "You loose") {
				score.comp++;
			}else {
				score.tie++;
			}

			document.querySelector('.js-result').innerHTML = 'Result: '+result;

			document.querySelector('.js-moves').innerHTML = `Moves:
		<img class="move-icon" src="./images/${userMove}-emoji.png" alt="">
		<img class="move-icon" src="./images/${computerMove}-emoji.png" alt="">`;

			// document.querySelector('.js-moves').innerHTML = `Moves: user ${userMove} : ${img_comp} computer`;

			localStorage.setItem('score', JSON.stringify(score));

			// console.log(score);
			// alert(`You picked ${userMove}. Computer picked ${computerMove}. ${result} score user: ${score.user} comp: ${score.comp} Tie: ${score.tie}`);

			updateScoreElement();

		}

		function updateScoreElement() {
			// console.log(score);
			document.querySelector('.js-score').innerHTML = `user: ${score.user} comp: ${score.comp} tie: ${score.tie}`;
			
		}

		function newGame() {
			score.user = 0;
			score.comp = 0;
			score.tie = 0;
			localStorage.removeItem('score');
			
			document.querySelector('.js-result').innerHTML = "Result:";
			document.querySelector('.js-moves').innerHTML = 'Moves:';

			updateScoreElement();
		}
		