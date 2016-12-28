# Podgest - For the Real World Podcasters

Podgest is a platform for Podcasters who want to answer questions from there community it is the only competition for a project by Matt Stauffer of Tighten.co. (http://mattstauffer.co)[Matt's Website]

Here are the things it will be able to do:
- Track Episodes
- Track Topics
- Allow Users to suggest topics
- Allow an admin to tag topics as accepted, or rejected
- Allow an admin to assign topics to episodes
- Allow users to comment on topics

I am currently just starting this project so there is not a lot there.
It will be a full SPA with NO PAGE RELOADS whatsoever!!!

I will be using The Laravel PHP Framework with MySQL for the backend, and Vue.js 2.0 with Axios and Vue Router for the front-end.
I am starting with the API and the UI Design. So all the functionality will be built before I even do any JavaScript.
So this will go from a Primarily PHP project to a Primarily JavaScript Project before it is complete.


## Current Test Coverage

### AdminCanEditAndDeleteEpisodes
- [x] Admin can edit episodes
- [x] Admin can delete episodes

### AdminCanEditAndDeleteTopics
- [x] Admin can edit topics
- [x] Admin can delete topics

### AssignTopicsToEpisodes
- [x] Admin can assign topics to episodes

### CreateEpisodes
- [x] Can create episodes
- [x] Episode cannot be created without a title

### CreateTopics
- [x] Cannot create topic without valid api token
- [x] Admin can create a topic
- [x] Admin cannot create topic with empty title
- [x] Successful topic creation returns id

### SuggestTopics
- [x] Can suggest a topic
- [x] Successful topic creation returns id
- [x] Cannot suggest if title is empty

### UpdateTopicStatis
- [x] Nonadmin cannot update topic status
- [x] Admin can update topic status
- [x] Admin can only use valid topic statuses

### UserCanEditAndDeleteTopics
- [x] User can edit topics they have suggested
- [x] User cannot edit topics they have not suggested
- [x] User cannot edit topics if the status has been changed
- [x] User can delete topics they suggested
- [x] User cannot delete topics they did not suggested
- [x] User cannot delete topics if the status has been changed

### UserCanRegister
- [x] A user can register

### UserCanViewEpisodes
- [x] User can view aired episodes
- [x] User can view single aired episode
- [x] User connot see unaired episodes

### UserCanViewTopics
- [x] User can view topics
- [x] User can view single topic

### Episode
- [x] Can get episodes that have aired

### Topic
- [x] Topic can validate status

### User
- [x] Can get is admin