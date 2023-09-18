<template>
  <section id="home">
    <img class="profile" src="@/assets/images/profile.png" />
    <div>
      <span>I'm Leo Angelo</span>
      <div class="glitch-text"></div>
    </div>
    <div class="wrapper">
      <i class="fa-brands fa-github"></i>
      <i class="fa-brands fa-linkedin"></i>
    </div>
    <div>
      <button class="btn btn-outline-light btn-sm">Download CV</button>
      <button class="btn btn-outline-light btn-sm" @click="scroll('contact')">
        Contact Us
      </button>
    </div>
  </section>
</template>
<script>
export default {
  data: () => {
    return {
      counter: 0,
      element: null,
      phrases: [
        "Web Developer",
        "Front-End Developer",
        "Back-End Developer",
        "Full Stack Developer",
        "UI/UX Designer",
      ],
      chars: "!<>-}]_\\/[{—=",
    };
  },
  mounted() {
    this.element = document.querySelector(".glitch-text");
    this.nextText();
    setInterval(() => {
      this.nextText();
    }, 3000);
  },
  methods: {
    nextText() {
      this.setText(this.phrases[this.counter]).then(() => {
        setTimeout(this.next, 4000);
      });
      this.counter = (this.counter + 1) % this.phrases.length;
    },
    setText(newText) {
      const oldText = this.element.innerText;
      const length = Math.max(oldText.length, newText.length);
      const promise = new Promise((resolve) => (this.resolve = resolve));
      this.queue = [];
      for (let i = 0; i < length; i++) {
        const from = oldText[i] || "";
        const to = newText[i] || "";
        const start = Math.floor(Math.random() * 40);
        const end = start + Math.floor(Math.random() * 40);
        this.queue.push({ from, to, start, end });
      }
      cancelAnimationFrame(this.frameRequest);
      this.frame = 0;
      this.update();
      return promise;
    },
    update() {
      let output = "";
      let complete = 0;
      for (let i = 0, n = this.queue.length; i < n; i++) {
        let { from, to, start, end, char } = this.queue[i];
        if (this.frame >= end) {
          complete++;
          output += to;
        } else if (this.frame >= start) {
          if (!char || Math.random() < 0.28) {
            char = this.randomChar();
            this.queue[i].char = char;
          }
          output += `<span class="glitch-code">${char}</span>`;
        } else {
          output += from;
        }
      }
      this.element.innerHTML = output;
      if (complete === this.queue.length) {
        this.resolve();
      } else {
        this.frameRequest = requestAnimationFrame(this.update);
        this.frame++;
      }
    },
    randomChar() {
      return this.chars[Math.floor(Math.random() * this.chars.length)];
    },
    scroll(element) {
      let el = document.querySelector(`#${element}`);
      el.scrollIntoView({ behavior: "smooth", block: "end" });
    },
  },
};
</script>

<style scoped lang="postcss">
section {
  height: 100vh;

  @media screen and (min-height: 1000px) {
    height: 800px;
  }

  display: grid;
  text-align: center;
  align-content: center;
  justify-content: center;

  & span {
    font-size: 1.5rem;
  }

  & img {
    width: 150px;
    margin: 0 auto;
  }

  & button {
    margin: 10px 5px;
  }

  .wrapper {
    height: 60px;
    display: flex;
    justify-content: center;

    & i {
      font-size: 2.5rem;
      margin: 5px;
    }
  }
}

.fa-brands {
  border-radius: 10px;
  animation: bounce 0.4s linear;

  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}

.fa-github:hover {
  padding-inline: 5px;
  color: #000000;
  background-color: #ffffff;
}

.fa-linkedin:hover {
  padding-inline: 7px;
  color: #0a66c2;
  background-color: #ffffff;
}

@keyframes bounce {
  40% {
    transform: scale(1.4);
  }

  60% {
    transform: scale(0.8);
  }

  80% {
    transform: scale(1.2);
  }

  100% {
    transform: scale(1);
  }
}

.glitch-text {
  height: 100px;

  font-family: "Montserrat-Bold";
  font-size: clamp(3rem, calc(2.65rem + 1.74vw), 4rem);
  line-height: 1;

  overflow: hidden;
  text-wrap: wrap;

  display: flex;
  align-items: center;
  justify-content: center;

  .glitch-code {
    font-family: "Montserrat-Bold";
    font-size: clamp(3rem, calc(2.65rem + 1.74vw), 4rem);
  }
}
</style>
