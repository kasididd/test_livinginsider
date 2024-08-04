

FROM python:3.12.0a5-bullseye
ADD /web/. /code/app/web
WORKDIR /code/app/web
COPY web/ /code/app
# RUN pip install -r requirements.txt
CMD python -m http.server