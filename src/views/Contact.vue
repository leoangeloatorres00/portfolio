<template>
  <section id="contact">
    <div>
      <div class="contact-form">
        <h4 class="my-2">Send us a message</h4>
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" placeholder="Name" />
        </div>
        <div class="mb-3">
          <label class="form-label">Email Address</label>
          <input
            type="email"
            class="form-control"
            placeholder="Email Address"
          />
        </div>
        <div class="mb-4">
          <label class="form-label">Message</label>
          <textarea
            class="form-control"
            rows="5"
            placeholder="Leave your message here"
          ></textarea>
        </div>
        <div class="d-grid gap-2">
          <a class="button">Send Message</a>
        </div>
      </div>
      <div>
        <h2 class="header my-2">Contact Us</h2>
        <p>
          We value your feedback, questions, and inquiries. <br />
          Feel free to get in touch with us.
        </p>

        <ul>
          <li>
            Address :
            <span
              >772 Bustamante St. Brgy. Poblacion, Candelaria, Quezon,
              4323</span
            >
          </li>
          <li>Email : <span>leoangeloatorres00@gmail.com</span></li>
          <li>Mobile Number: <span>+63927-274-4900</span></li>
        </ul>
      </div>
    </div>
  </section>
</template>

<style lang="postcss" scoped>
section {
  max-width: 1000px;
  margin-inline: auto;

  padding: 1rem;
}

section > div {
  margin-inline: auto;

  display: grid;
  gap: 40px;
  grid-template-columns: repeat(2, 1fr);

  @media screen and (max-width: 62rem) {
    grid-template-columns: repeat(1, 1fr);
  }
}

h4,
span {
  font-family: "Montserrat-Bold";
}

.contact-form {
  padding: 1rem;

  color: #818286;

  border-width: 1px;
  border-radius: 1rem;
  border-color: rgba(219, 234, 254, 1);
  background-color: rgba(255, 255, 255, 1);
}

.button {
  display: inline-block;
  border-radius: 0.5rem;
  padding: 0.75rem 1.25rem;
  text-align: center;
  font-size: 0.875rem;
  line-height: 1.25rem;
  font-weight: 600;

  text-decoration: none;
  font-family: "Montserrat-Bold";
}

.button {
  background-color: rgba(249, 250, 251, 1);
  color: rgba(107, 114, 128, 1);
  transition: all 0.15s ease;
}

.button:hover {
  background-color: rgb(230, 231, 233);
}
</style>
